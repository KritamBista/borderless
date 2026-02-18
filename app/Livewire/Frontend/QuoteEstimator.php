<?php

namespace App\Livewire\Frontend;

use App\Models\Company;
use App\Models\Country;
use App\Models\ProductCategory;
use Livewire\Component;


class QuoteEstimator extends Component
{

 public $company;
protected $listeners = ['auth-success' => 'saveQuote'];
    public $countries = [];
    public $categories = [];

    public $country_id = null;

    // Items (same country)
    public $items = [];

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

    public function proceed()
{
    if (!auth()->check()) {
        $this->dispatch('open-auth-modal');
        return;
    }
    $this->saveQuote();
}
    public function mount()
    {
        $this->company = Company::first();

        $this->countries = Country::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
                'code' => $c->code,
                'currency_code' => $c->currency_code,
                'exchange_rate_to_npr' => (float) $c->exchange_rate_to_npr,
                'shipping_rate_per_kg' => (float) $c->shipping_rate_per_kg,
                'service_fee_npr' => (float) $c->service_fee_npr,
                'min_chargeable_weight_kg' => (float) $c->min_chargeable_weight_kg,
            ])->toArray();

        $this->categories = ProductCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(fn ($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'duty_rate' => (float) $cat->duty_rate, // 0.10 = 10%
            ])->toArray();

        // Default: pick first country if available
        $this->country_id = $this->countries[0]['id'] ?? null;

        // Start with 1 item
        $this->items = [$this->blankItem()];

        $this->recalculate();
    }

    private function blankItem(): array
    {
        return [
            'product_name' => '',
            'product_link' => '',
            'category_id'  => $this->categories[0]['id'] ?? null,

            'unit_price_foreign' => 0,
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
        foreach ($this->items as $i => $item) {
            $this->items[$i]['unit_price_foreign'] = max(0, (float) ($item['unit_price_foreign'] ?? 0));
            $this->items[$i]['quantity'] = max(1, (int) ($item['quantity'] ?? 1));
            $this->items[$i]['weight_kg'] = max(0, (float) ($item['weight_kg'] ?? 0));
        }

        $this->recalculate();
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
        $country = $this->findCountry();

        if (!$country) {
            $this->totals = array_map(fn() => 0, $this->totals);
            return;
        }

        $vatRate = ((float)($this->company?->vat_percent ?? 13.00)) / 100;

        $exchange = (float) $country['exchange_rate_to_npr'];
        $shipRate = (float) $country['shipping_rate_per_kg'];
        $minW     = (float) $country['min_chargeable_weight_kg'];
        $service  = (float) $country['service_fee_npr'];

        $sumItemCost = $sumShipping = $sumCif = $sumDuty = $sumVat = $sumTotal = 0;

        foreach ($this->items as $i => $item) {
            $unit = (float) ($item['unit_price_foreign'] ?? 0);
            $qty  = (int)   ($item['quantity'] ?? 1);
            $w    = (float) ($item['weight_kg'] ?? 0);

            $dutyRate = $this->findDutyRate($item['category_id'] ?? null);

            $itemCost = $unit * $qty * $exchange;

            // weight rule: minimum chargeable weight
            $chargeableW = max($w, $minW);

            $shipping = $chargeableW * $shipRate;

            $cif = $itemCost + $shipping;

            $duty = $cif * $dutyRate;

            $vat = ($cif + $duty) * $vatRate;

            $total = $itemCost + $shipping + $duty + $vat;

            $this->items[$i]['item_cost_npr'] = $this->roundMoney($itemCost);
            $this->items[$i]['shipping_npr']  = $this->roundMoney($shipping);
            $this->items[$i]['cif_npr']       = $this->roundMoney($cif);
            $this->items[$i]['duty_npr']      = $this->roundMoney($duty);
            $this->items[$i]['vat_npr']       = $this->roundMoney($vat);
            $this->items[$i]['total_npr']     = $this->roundMoney($total);

            $sumItemCost += $itemCost;
            $sumShipping += $shipping;
            $sumCif      += $cif;
            $sumDuty     += $duty;
            $sumVat      += $vat;
            $sumTotal    += $total;
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
    }
    public function render()
    {

        return view('livewire.frontend.quote-estimator',[

            'country' => $this->findCountry(),
            'vatPercent' => (float) ($this->company?->vat_percent ?? 13.00),

        ])->layout('layouts.app', ['company' => $this->company]);
    }
}
