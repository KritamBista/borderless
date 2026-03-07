<?php

namespace App\Livewire\Frontend;

use App\Models\Company;
use App\Models\Country;
use App\Models\ProductCategory;
use Livewire\Component;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Coupon;
use App\Models\QuoteRevision;
use Illuminate\Support\Facades\Auth;
// use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuoteEstimator extends Component
{

    public $company;
    protected $listeners = ['auth-success' => 'handleAuthSuccess',    'reset-estimator' => 'resetEstimator',];
    public $countries = [];
    public $categories = [];

    public $country_id = null;

    // Items (same country)
    public $items = [];
    public string $coupon_code = '';

    public ?int $coupon_id = null;
    public ?array $applied_coupon = null; // ['code'=>..., 'type'=>..., 'value'=>...]
    public float $discount_npr = 0.0;
    public float $payable_npr = 0.0;


    // Totals
    public $totals = [
        'items_cost' => 0,
        'shipping'   => 0,
        'cif'        => 0,
        'duty'       => 0,
        'vat'        => 0,
        'service'    => 0,
        'grand'      => 0,
    ];

    public bool $showRevisionModal = false;

    public string $revision_reason = '';
    public string $revision_name = '';
    public string $revision_email = '';
    public string $revision_phone = '';

    public $link = "";

public string $service_fee_type = 'flat';
    public function handleAuthSuccess()
    {
        // scroll first
        $this->dispatch('scroll-to-proceed');

        // then continue flow
        $this->saveQuote();
    }
    public function resetEstimator(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->country_id = null;
        $this->items = [$this->blankItem()];

        $this->coupon_code = '';
        $this->coupon_id = null;
        $this->applied_coupon = null;

        $this->discount_npr = 0.0;
        $this->payable_npr = 0.0;

        $this->totals = [
            'items_cost' => 0,
            'shipping' => 0,
            'cif' => 0,
            'duty' => 0,
            'vat' => 0,
            'service' => 0,
            'grand' => 0,
        ];
    }
    public function clearQuoteErrors(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function proceed()
    {


        $countryId = $this->countryIdOrNull();
        if (!$countryId) {
            $this->totals = array_map(fn() => 0, $this->totals);
            $this->addError('country_id', 'Please select a country.');
            return;
        }
        $user = Auth::user();

        if (!$user) {
            $cleanItems = collect($this->items)->map(function ($item) {
                return [
                    'product_name' => $item['product_name'] ?? '',
                    'product_link' => $item['product_link'] ?? '',
                    'category_id' => $item['category_id'] ?? null,
                    // 'unit_price_foreign' => $item['unit_price_foreign'] ?? 0,'unit_price_foreign' => $item['unit_price_foreign'] ?? null,
                    'weight_kg' => $item['weight_kg'] ?? 0.5,
                    'unit_price_foreign' => $item['unit_price_foreign'] ?? null,
                    'quantity' => $item['quantity'] ?? 1,
                    // 'weight_kg' => $item['weight_kg'] ?? 0,
                ];
            })->toArray();

            session([
                'quote_draft' => [
                    'country_id' => $this->country_id,
                    'items' => $cleanItems,
                    'coupon_code' => $this->coupon_code,
                    'coupon_id' => $this->coupon_id,
                    'applied_coupon' => $this->applied_coupon,
                ]
            ]);
            $this->dispatch('open-auth-modal');
            return;
        }


        // if (!auth()->check()) {
        //     $this->dispatch('open-auth-modal');
        //     return;
        // }


        $this->saveQuote();
    }
    // public function updatedCountryId($value): void
    // {
    //     $this->resetErrorBag('country_id');
    //     $this->resetValidation('country_id');

    //     $this->recalculate();
    // }
    public function updatedCountryId($value): void
    {
        $this->resetErrorBag('country_id');
        $this->resetValidation('country_id');

        $countryId = $this->countryIdOrNull();
        if (!$countryId) {
            $this->recalculate();
            return;
        }

        $country = Country::find($countryId);
        $minW = (float)($country?->min_chargeable_weight_kg ?? 0);
        $minW = $minW > 0 ? $minW : 0.3;

        // ✅ only set if user hasn't typed anything yet
        foreach ($this->items as $i => $item) {
            $current = $item['weight_kg'] ?? null;

            if (!is_numeric($current) || (float)$current <= 0) {
                $this->items[$i]['weight_kg'] = $minW;
            }
        }

        $this->recalculate();
    }
    public function mount()
    {

        $this->items = [];
        // $this->blankItem();
        $link = request()->query('product-url') ?? '';
        // dd($this->link);
        $this->company = Company::first();

        $this->countries = Country::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(fn($c) => [
                'id' => $c->id,

                'name' => $c->name,
                // 'flag' => $this->getCountryFlagEmoji($c->code ?? 'XX'),
                'code' => $c->code,
                'currency_code' => $c->currency_code,
                'exchange_rate_to_npr' => (float) $c->exchange_rate_to_npr,
                'shipping_rate_per_kg' => (float) $c->shipping_rate_per_kg,
                'service_fee_npr' => (float) $c->service_fee_npr,
                'min_chargeable_weight_kg' => (float) $c->min_chargeable_weight_kg,
                'flag' => $c->flag ? Storage::url($c->flag) : null,
            ])->toArray();

        $this->categories = ProductCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(fn($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'duty_rate' => (float) $cat->duty_rate,
                'is_vat_applicable' => (bool) $cat->is_vat_applicable,
            ])->toArray();

        // Default: pick first country if available
        // $this->country_id = $this->countries[0]['id'] ?? null;
        $this->country_id = null;

        // Start with 1 item
        // $this->items = [$this->blankItem()];
        $item = $this->blankItem();   // keep your structure
        $item['product_link'] = $link; // inject link into it

        $this->items = [$item];

        // $this->recalculate();
        $this->payable_npr = (float)($this->totals['grand'] ?? 0);
        $draft = session()->pull('quote_draft'); // get + delete immediately

        if ($draft) {
            $this->country_id = $draft['country_id'] ?? $this->country_id;
            $this->items = $draft['items'] ?? [$this->blankItem()];
            $this->coupon_code = $draft['coupon_code'] ?? '';
            $this->coupon_id = $draft['coupon_id'] ?? null;
            $this->applied_coupon = $draft['applied_coupon'] ?? null;

            $this->recalculate();
        }
    }


    private function isVatApplicable($categoryId): bool
    {
        foreach ($this->categories as $cat) {
            if ((int) $cat['id'] === (int) $categoryId) {
                return (bool) ($cat['is_vat_applicable'] ?? true);
            }
        }

        return true;
    }
    private function blankItem(): array
    {
        return [
            'product_name' => '',
            'product_link' => '',
            'category_id'  =>  null,

            'unit_price_foreign' => null,
            'quantity' => 1,
            'weight_kg' => 0.5, // total weight of this item line

            // computed
            'item_cost_npr' => 0,
            'shipping_npr'  => 0,
            'cif_npr'       => 0,
            'duty_npr'      => 0,
            'vat_npr'       => 0,
            'total_npr'     => 0,
        ];
    }

    public function addItem()
    {
        $this->items[] = $this->blankItem();
        $this->recalculate();
    }

    public function removeItem($index)
    {
        if (count($this->items) <= 1) return;

        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->recalculate();
    }

    // Livewire will call this on any change (typing/selecting)
    public function updated($name, $value)
    {
        // Keep numbers sane
        // foreach ($this->items as $i => $item) {
        //     $this->items[$i]['unit_price_foreign'] = max(0, (float) ($item['unit_price_foreign'] ?? 0));
        //     $this->items[$i]['quantity'] = max(1, (int) ($item['quantity'] ?? 1));
        //     $this->items[$i]['weight_kg'] = max(0, (float) ($item['weight_kg'] ?? 0));
        // }

        $this->recalculate();
    }

    protected function validationAttributes(): array
    {
        return [
            'country_id' => 'country',
            'items.*.product_name' => 'product name',
            'items.*.product_link' => 'product link',
            'items.*.category_id' => 'category',
            'items.*.unit_price_foreign' => 'unit price',
            'items.*.quantity' => 'quantity',
            'items.*.weight_kg' => 'weight (kg)',
        ];
    }

    public function openRevisionModal()
    {


        // Clear old errors first (important)
        $this->resetErrorBag();
        // $this->resetValidation();

        // Validate all items before opening modal
        $this->validate([

            'items.*.product_name'       => 'required|string|max:255',
            'items.*.product_link'       => 'required|url', // keep string; url validation optional
            'items.*.unit_price_foreign' => 'required|numeric|min:0.01',
        ], [
            'items.*.product_name.required' => 'Product name is required.',
            'items.*.product_link.required' => 'Product link is required.',
            'items.*.unit_price_foreign.required' => 'Unit price is required.',
            'items.*.unit_price_foreign.min' => 'Unit price must be greater than 0.',
        ]);
        $countryId = $this->countryIdOrNull();
        // dd($countryId);
        if (!$countryId) {
            $this->addError('country_id', 'Please select a country.');
            return;
        }

        // Prefill user data if logged in
        if (auth()->check()) {
            $this->revision_name  = auth()->user()->name ?? '';
            $this->revision_email = auth()->user()->email ?? '';
            $this->revision_phone = auth()->user()->phone ?? '';
        }

        // Phone must not be empty (for both guest + logged in)
        // if (trim($this->revision_phone) === '') {
        //     $this->addError('revision_phone', 'Phone number is required to request a revision.');
        //     return;
        // }

        // Open modal ONLY if all validations passed
        $this->showRevisionModal = true;
    }
    // use App\Models\QuoteRevision;

    public function submitRevision()
    {
        $rules = [
            'revision_reason' => 'required|min:5',
            'revision_phone'  => 'required|digits_between:7,15',

        ];

        if (!auth()->check()) {
            $rules['revision_name'] = 'required|min:2';
            $rules['revision_email'] = 'required|email';
        }

        $this->validate($rules);
        $countryId = $this->countryIdOrNull();
        if (!$countryId) {
            $this->addError('country_id', 'Please select a country.');
            return;
        }

        $country = Country::find($countryId);
        if (!$country) {
            $this->addError('country_id', 'Invalid country selected.');
            return;
        }
        // First ensure quote exists (you already created quote on Proceed flow)
        $this->recalculate();

        // $quote = Quote::create([
        //     'user_id' => auth()->id(),
        //     'country_id' => $country->id,
        //     // 'currency_code_snapshot '=>$country->currency,
        //     'currency_code_snapshot' => $country->currency_code,

        //     'exchange_rate_to_npr_snapshot' => (float)$country->exchange_rate_to_npr,
        //     'shipping_rate_per_kg_snapshot' => (float)$country->shipping_rate_per_kg,
        //     'service_fee_npr_snapshot' => (float)$country->service_fee_npr,
        //     // 'vat_rate_snapshot' => (float)$vatRate,
        //     'grand_total_npr' => $this->totals['grand'] ?? 0,
        //     'discount_npr' => $this->discount_npr ?? 0,
        //     'payable_npr' => $this->payable_npr ?? 0,
        //     'status' => 'request_for_revision',
        // ]);

        $quote = Quote::create([
    'user_id' => auth()->id(),
    'country_id' => $country->id,
    'currency_code_snapshot' => $country->currency_code,
    'exchange_rate_to_npr_snapshot' => (float)$country->exchange_rate_to_npr,
    'shipping_rate_per_kg_snapshot' => (float)$country->shipping_rate_per_kg,
    'service_fee_npr_snapshot' => (float)$country->service_fee_npr,
    'service_fee_type' => $this->service_fee_type,
    'service_fee_percent_snapshot' => (float)($country->service_fee_percent ?? 0),
    'service_fee_threshold_snapshot' => (float)($country->service_fee_threshold_npr ?? 0),
    'vat_rate_snapshot' => (float)(((float)($this->company?->vat_percent ?? 13.00)) / 100),

    'items_cost_npr_total' => (float)($this->totals['items_cost'] ?? 0),
    'shipping_npr_total'   => (float)($this->totals['shipping'] ?? 0),
    'cif_npr_total'        => (float)($this->totals['cif'] ?? 0),
    'duty_npr_total'       => (float)($this->totals['duty'] ?? 0),
    'vat_npr_total'        => (float)($this->totals['vat'] ?? 0),
    'grand_total_npr'      => (float)($this->totals['grand'] ?? 0),

    'discount_npr' => (float)($this->discount_npr ?? 0),
    'payable_npr' => (float)($this->payable_npr ?? 0),
    'status' => 'request_for_revision',
]);
        QuoteRevision::create([
            'quote_id' => $quote->id,
            'user_id' => auth()->id(),
            'contact_name' => $this->revision_name,
            'contact_email' => $this->revision_email,
            'contact_phone' => $this->revision_phone,
            'reason' => $this->revision_reason,
        ]);

        $this->showRevisionModal = false;

        // session()->flash('success', 'Revision request submitted successfully.');
        return redirect()->route('revision.success');
    }

    private function findCountry(): ?array
    {
        foreach ($this->countries as $c) {
            if ((int)$c['id'] === (int)$this->country_id) return $c;
        }
        return null;
    }

    private function findDutyRate($categoryId): float
    {
        foreach ($this->categories as $cat) {
            if ((int)$cat['id'] === (int)$categoryId) return (float)$cat['duty_rate'];
        }
        return 0.0;
    }

    private function roundMoney($n): float
    {
        // Round to nearest 1 (you can change later to 10/50/100)
        return round($n, 2);
    }

    public function recalculate()
{
    $countryId = $this->countryIdOrNull();

    if (!$countryId) {
        $this->totals = array_map(fn() => 0, $this->totals);
        $this->discount_npr = 0.0;
        $this->payable_npr = 0.0;
        return;
    }

    $country = Country::find($countryId);

    if (!$country) {
        $this->totals = array_map(fn() => 0, $this->totals);
        $this->discount_npr = 0.0;
        $this->payable_npr = 0.0;
        return;
    }

    $vatRate = ((float) ($this->company?->vat_percent ?? 13.00)) / 100;

    $exchange = (float) $country->exchange_rate_to_npr;
    $shipRate = (float) $country->shipping_rate_per_kg;

    $minW = (float) ($country->min_chargeable_weight_kg ?? 0);
    $minW = $minW > 0 ? $minW : 0.3;

    $flatServiceFee = (float) ($country->service_fee_npr ?? 0);
    $serviceFeeThreshold = (float) ($country->service_fee_threshold_npr ?? 0);
    $serviceFeePercent = (float) ($country->service_fee_percent ?? 0);

    $sumItemCost = 0;
    $sumShipping = 0;
    $sumCif = 0;
    $sumDuty = 0;
    $sumVat = 0;
    $sumTotal = 0;

    foreach ($this->items as $i => $item) {
        $unit = is_numeric($item['unit_price_foreign'] ?? null) ? (float) $item['unit_price_foreign'] : 0.0;
        $w = is_numeric($item['weight_kg'] ?? null) ? (float) $item['weight_kg'] : 0.0;
        $qty = (int) ($item['quantity'] ?? 1);

        $dutyRate = $this->findDutyRate($item['category_id'] ?? null);
        $vatApplicable = $this->isVatApplicable($item['category_id'] ?? null);

        $itemCost = $unit * $qty * $exchange;

        $chargeableW = max($w, $minW);
        $shipping = $chargeableW * $shipRate;

        $cif = $itemCost + $shipping;
        $duty = $cif * $dutyRate;
        $vat = $vatApplicable ? (($cif + $duty) * $vatRate) : 0;

        $total = $itemCost + $shipping + $duty + $vat;

        $this->items[$i]['item_cost_npr'] = $this->roundMoney($itemCost);
        $this->items[$i]['shipping_npr']  = $this->roundMoney($shipping);
        $this->items[$i]['cif_npr']       = $this->roundMoney($cif);
        $this->items[$i]['duty_npr']      = $this->roundMoney($duty);
        $this->items[$i]['vat_npr']       = $this->roundMoney($vat);
        $this->items[$i]['total_npr']     = $this->roundMoney($total);

        $sumItemCost += $itemCost;
        $sumShipping += $shipping;
        $sumCif += $cif;
        $sumDuty += $duty;
        $sumVat += $vat;
        $sumTotal += $total;
    }

    // Dynamic service fee logic
    $service = $flatServiceFee;
    $serviceFeeType = 'flat';

    if (
        $serviceFeeThreshold > 0 &&
        $serviceFeePercent > 0 &&
        $sumItemCost > $serviceFeeThreshold
    ) {
        $service = $sumItemCost * ($serviceFeePercent / 100);
        $serviceFeeType = 'percent';
    }

    $grand = $sumTotal + $service;

    $this->totals = [
        'items_cost' => $this->roundMoney($sumItemCost),
        'shipping'   => $this->roundMoney($sumShipping),
        'cif'        => $this->roundMoney($sumCif),
        'duty'       => $this->roundMoney($sumDuty),
        'vat'        => $this->roundMoney($sumVat),
        'service'    => $this->roundMoney($service),
        'grand'      => $this->roundMoney($grand),
    ];

    // optional extra state if you want to show later in UI/debug
    $this->service_fee_type = $serviceFeeType;

    $this->recomputeDiscountAndPayable();
}
    // public function recalculate()
    // {

    //     $countryId = $this->countryIdOrNull();
    //     if (!$countryId) {
    //         $this->totals = array_map(fn() => 0, $this->totals);
    //         return;
    //     }
    //     $country = Country::find($countryId);
    //     // dd('jere');
    //     $vatRate = ((float)($this->company?->vat_percent ?? 13.00)) / 100;

    //     $exchange = (float) $country['exchange_rate_to_npr'];
    //     $shipRate = (float) $country['shipping_rate_per_kg'];
    //     // $minW     = (float) $country['min_chargeable_weight_kg'];
    //     $minW = (float)($country['min_chargeable_weight_kg'] ?? 0);
    //     $minW = $minW > 0 ? $minW : 0.3; // default fallback
    //     $service  = (float) $country['service_fee_npr'];

    //     $sumItemCost = $sumShipping = $sumCif = $sumDuty = $sumVat = $sumTotal = 0;

    //     foreach ($this->items as $i => $item) {
    //         // $unit = (float) ($item['unit_price_foreign'] ?? 0);
    //         $unit = is_numeric($item['unit_price_foreign'] ?? null) ? (float)$item['unit_price_foreign'] : 0.0;
    //         $w    = is_numeric($item['weight_kg'] ?? null) ? (float)$item['weight_kg'] : 0.0;
    //         $qty  = (int)   ($item['quantity'] ?? 1);
    //         // $w    = (float) ($item['weight_kg'] ?? 0);

    //         $dutyRate = $this->findDutyRate($item['category_id'] ?? null);

    //         $itemCost = $unit * $qty * $exchange;

    //         // weight rule: minimum chargeable weight
    //         $chargeableW = max($w, $minW);

    //         $shipping = $chargeableW * $shipRate;

    //         $cif = $itemCost + $shipping;

    //         $duty = $cif * $dutyRate;

    //         $vat = ($cif + $duty) * $vatRate;

    //         $total = $itemCost + $shipping + $duty + $vat;

    //         $this->items[$i]['item_cost_npr'] = $this->roundMoney($itemCost);
    //         $this->items[$i]['shipping_npr']  = $this->roundMoney($shipping);
    //         $this->items[$i]['cif_npr']       = $this->roundMoney($cif);
    //         $this->items[$i]['duty_npr']      = $this->roundMoney($duty);
    //         $this->items[$i]['vat_npr']       = $this->roundMoney($vat);
    //         $this->items[$i]['total_npr']     = $this->roundMoney($total);

    //         $sumItemCost += $itemCost;
    //         $sumShipping += $shipping;
    //         $sumCif      += $cif;
    //         $sumDuty     += $duty;
    //         $sumVat      += $vat;
    //         $sumTotal    += $total;
    //     }

    //     $grand = $sumTotal + $service;

    //     $this->totals = [
    //         'items_cost' => $this->roundMoney($sumItemCost),
    //         'shipping'   => $this->roundMoney($sumShipping),
    //         'cif'        => $this->roundMoney($sumCif),
    //         'duty'       => $this->roundMoney($sumDuty),
    //         'vat'        => $this->roundMoney($sumVat),
    //         'service'    => $this->roundMoney($service),
    //         'grand'      => $this->roundMoney($grand),
    //     ];
    //     $this->recomputeDiscountAndPayable();
    // }
    private function recomputeDiscountAndPayable(): void
    {
        $grand = (float)($this->totals['grand'] ?? 0);

        $discount = 0.0;

        if ($this->applied_coupon) {
            $type = $this->applied_coupon['type'];
            $value = (float)$this->applied_coupon['value'];

            if ($type === 'percent') {
                $discount = $grand * ($value / 100);
                // optional max discount cap if you stored it in applied_coupon
                if (isset($this->applied_coupon['max_discount_npr']) && $this->applied_coupon['max_discount_npr'] !== null) {
                    $discount = min($discount, (float)$this->applied_coupon['max_discount_npr']);
                }
            } elseif ($type === 'flat') {
                $discount = $value;
            }
        }

        // never exceed grand total
        $discount = min($discount, $grand);
        $discount = round($discount, 2);

        $this->discount_npr = $discount;
        $this->payable_npr  = round(max(0, $grand - $discount), 2);
    }

    public function applyCoupon(): void
    {
        $code = strtoupper(trim($this->coupon_code));
        // dd($code);

        if ($code === '') {
            $this->addError('coupon_code', 'Enter a coupon code.');
            return;
        }

        $this->resetErrorBag('coupon_code');

        $grand = (float)($this->totals['grand'] ?? 0);

        $coupon = Coupon::query()
            ->where('code', $code)
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            $this->addError('coupon_code', 'Invalid coupon code.');
            return;
        }

        // date window
        if ($coupon->starts_at && now()->lt($coupon->starts_at)) {
            $this->addError('coupon_code', 'This coupon is not active yet.');
            return;
        }
        if ($coupon->ends_at && now()->gt($coupon->ends_at)) {
            $this->addError('coupon_code', 'This coupon has expired.');
            return;
        }

        // usage limit
        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            $this->addError('coupon_code', 'This coupon has reached its usage limit.');
            return;
        }

        // min order
        if ($coupon->min_order_npr !== null && $grand < (float)$coupon->min_order_npr) {
            $this->addError('coupon_code', 'Minimum order requirement not met for this coupon.');
            return;
        }

        // Apply (store snapshot in component state)
        $this->coupon_id = $coupon->id;
        $this->applied_coupon = [
            'code' => $coupon->code,
            'type' => $coupon->type,          // percent|flat
            'value' => (float)$coupon->value, // 10.00 or 500.00
            'max_discount_npr' => $coupon->max_discount_npr !== null ? (float)$coupon->max_discount_npr : null,
        ];

        $this->recomputeDiscountAndPayable();

        session()->flash('success', "Coupon applied: {$coupon->code}");
    }

    public function removeCoupon(): void
    {
        $this->coupon_code = '';
        $this->coupon_id = null;
        $this->applied_coupon = null;

        $this->discount_npr = 0.0;
        $this->payable_npr = (float)($this->totals['grand'] ?? 0);

        $this->resetErrorBag('coupon_code');
    }

    private function countryIdOrNull(): ?int
    {
        // if alpine/entangle sends object/array
        if (is_array($this->country_id)) {
            return isset($this->country_id['id']) ? (int) $this->country_id['id'] : null;
        }

        // normal int
        if (is_numeric($this->country_id)) {
            $id = (int) $this->country_id;
            return $id > 0 ? $id : null;
        }

        return null;
    }
    public function saveQuote()
    {


        // dd('here');
        // if (!auth()->check()) {
        //     $this->dispatch('open-auth-modal');
        //     return;
        // }
        // $this->validate([
        //     // 'country_id'                 => 'required|exists:countries,id',

        //     'items.*.product_name'       => 'required|string|max:255',
        //     'items.*.category_id' => 'required|exists:product_categories,id',
        //     'items.*.product_link'       => 'required|url',           // ← enforce required here
        //     'items.*.quantity'           => 'required|integer|min:1',
        //     'items.*.weight_kg'          => 'required|numeric|min:0.01',
        //     'items.*.unit_price_foreign' => 'nullable|numeric|min:0',
        // ]);
        $this->validate([
            'items.*.product_name'       => 'required|string|max:255',
            'items.*.category_id'        => 'required|exists:product_categories,id',
            'items.*.product_link'       => 'required|url',
            'items.*.quantity'           => 'required|integer|min:1',
            'items.*.weight_kg'          => 'required|numeric|min:0.01',
            'items.*.unit_price_foreign' => 'nullable|numeric|min:0',
        ], [
            'items.*.weight_kg.min' => 'Weight must be greater than 0.',
            'items.*.unit_price_foreign.min' => 'Unit price cannot be negative.',
        ]);
        $countryId = $this->countryIdOrNull();
        // dd($countryId);
        if (!$countryId) {
            $this->addError('country_id', 'Please select a country.');
            return;
        }

        $country = Country::find($countryId);
        // dd($country);
        if (!$country) {
            $this->addError('country_id', 'Invalid country selected.');
            return;
        }

        // Make sure calculations are updated
        $this->recalculate();


        // VAT snapshot (store as RATE, e.g. 0.13)
        $vatRate = ((float)($this->company?->vat_percent ?? 13.00)) / 100;
        // dd($this->items);
        // Basic validation
        // foreach ($this->items as $idx => $it) {
        //     if (empty(trim($it['product_name'] ?? ''))) {
        //         $this->addError("items.$idx.product_name", "Product name is required.");
        //         return;
        //     }
        //     if (empty(trim($it['product_link'] ?? ''))) {
        //         $this->addError("items.$idx.product_link", "Product Link is required.");
        //         return;
        //     }
        //     if ((float)($it['weight_kg'] ?? 0) <= 0) {
        //         $this->addError("items.$idx.weight_kg", "Weight must be greater than 0.");
        //         return;
        //     }
        //     if ((float)($it['unit_price_foreign'] ?? 0) < 0) {
        //         $this->addError("items.$idx.unit_price_foreign", "Price cannot be negative.");
        //         return;
        //     }
        //     if ((int)($it['quantity'] ?? 1) < 1) {
        //         $this->addError("items.$idx.quantity", "Quantity must be at least 1.");
        //         return;
        //     }
        // }

        try {
            $quote = DB::transaction(function () use ($country, $vatRate) {
                $user = Auth::user();

                // $quote = Quote::create([
                //     'user_id' => $user->id,
                //     'country_id' => $country->id,
                //     'currency_code_snapshot' => $country->currency_code,
                //     'exchange_rate_to_npr_snapshot' => (float)$country->exchange_rate_to_npr,
                //     'shipping_rate_per_kg_snapshot' => (float)$country->shipping_rate_per_kg,
                //     'service_fee_npr_snapshot' => (float)$country->service_fee_npr,
                //     'vat_rate_snapshot' => (float)$vatRate,
                //     'items_cost_npr_total' => (float)($this->totals['items_cost'] ?? 0),
                //     'shipping_npr_total'   => (float)($this->totals['shipping'] ?? 0),
                //     'cif_npr_total'        => (float)($this->totals['cif'] ?? 0),
                //     'duty_npr_total'       => (float)($this->totals['duty'] ?? 0),
                //     'vat_npr_total'        => (float)($this->totals['vat'] ?? 0),
                //     'grand_total_npr'      => (float)($this->totals['grand'] ?? 0),
                //     'coupon_id' => $this->coupon_id,
                //     'coupon_code_snapshot' => $this->applied_coupon['code'] ?? null,
                //     'coupon_type_snapshot' => $this->applied_coupon['type'] ?? null,
                //     'coupon_value_snapshot' => $this->applied_coupon ? (float)$this->applied_coupon['value'] : null,
                //     'discount_npr' => (float)$this->discount_npr,
                //     'payable_npr' => (float)$this->payable_npr,
                //     'status' => 'proceed-to-order',
                // ]);
                $quote = Quote::create([
    'user_id' => $user->id,
    'country_id' => $country->id,
    'currency_code_snapshot' => $country->currency_code,
    'exchange_rate_to_npr_snapshot' => (float)$country->exchange_rate_to_npr,
    'shipping_rate_per_kg_snapshot' => (float)$country->shipping_rate_per_kg,
    'service_fee_npr_snapshot' => (float)$country->service_fee_npr,
    'service_fee_type' => $this->service_fee_type,
    'service_fee_percent_snapshot' => (float)($country->service_fee_percent ?? 0),
    'service_fee_threshold_snapshot' => (float)($country->service_fee_threshold_npr ?? 0),
    'vat_rate_snapshot' => (float)$vatRate,
    'items_cost_npr_total' => (float)($this->totals['items_cost'] ?? 0),
    'shipping_npr_total'   => (float)($this->totals['shipping'] ?? 0),
    'cif_npr_total'        => (float)($this->totals['cif'] ?? 0),
    'duty_npr_total'       => (float)($this->totals['duty'] ?? 0),
    'vat_npr_total'        => (float)($this->totals['vat'] ?? 0),
    'grand_total_npr'      => (float)($this->totals['grand'] ?? 0),
    'coupon_id' => $this->coupon_id,
    'coupon_code_snapshot' => $this->applied_coupon['code'] ?? null,
    'coupon_type_snapshot' => $this->applied_coupon['type'] ?? null,
    'coupon_value_snapshot' => $this->applied_coupon ? (float)$this->applied_coupon['value'] : null,
    'discount_npr' => (float)$this->discount_npr,
    'payable_npr' => (float)$this->payable_npr,
    'status' => 'proceed-to-order',
]);

                foreach ($this->items as $item) {
                    $categoryId = $item['category_id'] ?? null;
                    $dutyRate = $this->findDutyRate($categoryId);

                    QuoteItem::create([
                        'quote_id' => $quote->id,
                        'product_category_id' => $categoryId,
                        'product_name' => $item['product_name'] ?? '',
                        'product_link' => $item['product_link'] ?? null,
                        'unit_price_foreign' => (float)($item['unit_price_foreign'] ?? 0),
                        'quantity' => (int)($item['quantity'] ?? 1),
                        'weight_kg' => (float)($item['weight_kg'] ?? 0),
                        'duty_rate_snapshot' => (float)$dutyRate,
                        'item_cost_npr' => (float)($item['item_cost_npr'] ?? 0),
                        'shipping_cost_npr' => (float)($item['shipping_npr'] ?? 0),
                        'cif_npr' => (float)($item['cif_npr'] ?? 0),
                        'duty_npr' => (float)($item['duty_npr'] ?? 0),
                        'vat_npr' => (float)($item['vat_npr'] ?? 0),
                        'total_npr' => (float)($item['total_npr'] ?? 0),
                    ]);
                }

                return $quote;
            });

            return redirect()->route('checkout', $quote->public_id);
        } catch (\Throwable $e) {
            report($e);
            $this->addError('save', 'Failed to save quote. Please try again.');
        }

        // try {
        //     // dd($userId);
        //     DB::transaction(function () use ($country, $vatRate) {
        //         $user = Auth::user();

        //         // Create quote header
        //         $quote = Quote::create([
        //             'user_id' => $user->id,
        //             'country_id' => $country->id,

        //             'currency_code_snapshot' => $country->currency_code,
        //             'exchange_rate_to_npr_snapshot' => (float)$country->exchange_rate_to_npr,
        //             'shipping_rate_per_kg_snapshot' => (float)$country->shipping_rate_per_kg,
        //             'service_fee_npr_snapshot' => (float)$country->service_fee_npr,
        //             'vat_rate_snapshot' => (float)$vatRate,

        //             'items_cost_npr_total' => (float)($this->totals['items_cost'] ?? 0),
        //             'shipping_npr_total'   => (float)($this->totals['shipping'] ?? 0),
        //             'cif_npr_total'        => (float)($this->totals['cif'] ?? 0),
        //             'duty_npr_total'       => (float)($this->totals['duty'] ?? 0),
        //             'vat_npr_total'        => (float)($this->totals['vat'] ?? 0),
        //             'grand_total_npr'      => (float)($this->totals['grand'] ?? 0),
        //             // coupon snapshot + computed
        //             'coupon_id' => $this->coupon_id,
        //             'coupon_code_snapshot' => $this->applied_coupon['code'] ?? null,
        //             'coupon_type_snapshot' => $this->applied_coupon['type'] ?? null,
        //             'coupon_value_snapshot' => $this->applied_coupon ? (float)$this->applied_coupon['value'] : null,
        //             'discount_npr' => (float)$this->discount_npr,
        //             'payable_npr' => (float)$this->payable_npr,

        //             'status' => 'proceed-to-order',
        //         ]);

        //         // Create quote items
        //         foreach ($this->items as $item) {
        //             $categoryId = $item['category_id'] ?? null;
        //             $dutyRate = $this->findDutyRate($categoryId);

        //             QuoteItem::create([
        //                 'quote_id' => $quote->id,
        //                 'product_category_id' => $categoryId,

        //                 'product_name' => $item['product_name'] ?? '',
        //                 'product_link' => $item['product_link'] ?? null,

        //                 'unit_price_foreign' => (float)($item['unit_price_foreign'] ?? 0),
        //                 'quantity' => (int)($item['quantity'] ?? 1),
        //                 'weight_kg' => (float)($item['weight_kg'] ?? 0),

        //                 'duty_rate_snapshot' => (float)$dutyRate,

        //                 // computed fields (already calculated live)
        //                 'item_cost_npr' => (float)($item['item_cost_npr'] ?? 0),
        //                 'shipping_cost_npr' => (float)($item['shipping_npr'] ?? 0),
        //                 'cif_npr' => (float)($item['cif_npr'] ?? 0),
        //                 'duty_npr' => (float)($item['duty_npr'] ?? 0),
        //                 'vat_npr' => (float)($item['vat_npr'] ?? 0),
        //                 'total_npr' => (float)($item['total_npr'] ?? 0),
        //             ]);
        //         }
        //         // Notify UI
        //         session()->flash('success', "Quote saved successfully! Quote ID: {$quote->id}");
        //         $this->dispatch('quote-saved', quoteId: $quote->id);
        //         return redirect()->route('checkout', $quote->public_id);
        //     });
        // } catch (\Throwable $e) {
        //     report($e);
        //     $this->addError('save', 'Failed to save quote. Please try again.');
        // }
    }

    public function render()
    {

        return view('livewire.frontend.quote-estimator', [

            'country' => $this->findCountry(),
            'vatPercent' => (float) ($this->company?->vat_percent ?? 13.00),

        ])->layout('layouts.app', ['company' => $this->company]);
    }
}
