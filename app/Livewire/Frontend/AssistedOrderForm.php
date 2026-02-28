<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Country;
use App\Models\AssistedOrder;
use App\Models\AssistedOrderItem;
use Illuminate\Support\Str;

class AssistedOrderForm extends Component
{
    public $countries;

    public $country_id;
    public $contact_name;
    public $contact_email;
    public $contact_phone;

    public $items = [];

    public function mount()
    {

        $link = request()->query('product-url') ?? '';

        $this->countries = Country::orderBy('name')->get();

        $this->items[] = [
            'product_name' => '',
            'product_link' => $link,
            'quantity'     => 1,
            'weight_kg'    => '',
        ];
        if (auth()->user()) {
            $this->contact_name  = auth()->user()->name;
            $this->contact_email = auth()->user()->email;
            $this->contact_phone = auth()->user()->phone ?? '';
        }
    }

    protected function rules()
    {
        return [
            'country_id'                 => 'required|exists:countries,id',
            'contact_name'               => 'required|string|max:255',
            'contact_email'              => 'nullable|email|max:255',
            'contact_phone'              => 'required|string|max:50',

            'items'                      => 'required|array|min:1',
            'items.*.product_name'       => 'required|string|max:255',
            'items.*.product_link'       => 'nullable|url',
            'items.*.quantity'           => 'required|integer|min:1',
            'items.*.weight_kg'          => 'required|numeric|min:0.01',
            'items' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    $hasAtLeastOneLink = collect($value)->contains(function ($item) {
                        return !empty($item['product_link']) && filter_var($item['product_link'], FILTER_VALIDATE_URL);
                    });

                    if (!$hasAtLeastOneLink) {
                        $fail('At least one product must have a valid product link.');
                    }
                },
            ],
        ];
    }
protected $validationAttributes = [
        'country_id'    => 'country',
        'contact_phone' => 'phone number',
        'items.*.product_link' => 'product link',
    ];
    public function addItem()
    {
        $this->items[] = [
            'product_name' => '',
            'product_link' => '',
            'quantity'     => 1,
            'weight_kg'    => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function submit()
    {

    $validated = $this->validate();
    // Extra safety (though validate() already failed if data is bad)
        if (empty($this->country_id) || empty(trim($this->contact_phone))) {
            $this->addError('contact_phone', 'Phone number is required.');
            return;
        }

        // Check again just in case (defense in depth)
        $hasLink = collect($this->items)->contains(fn($item) => filled($item['product_link']));
        if (!$hasLink) {
            $this->addError('items', 'At least one product link is required.');
            return;
        }
       try {
            $order = AssistedOrder::create([
                'user_id'       => auth()->id() ?? null,           // better than empty string
                'country_id'    => $this->country_id,
                'contact_name'  => $this->contact_name,
                'contact_email' => $this->contact_email,
                'contact_phone' => $this->contact_phone,
                'status'        => 'submitted',
            ]);

            foreach ($this->items as $item) {
                AssistedOrderItem::create([
                    'assisted_order_id' => $order->id,
                    'product_name'      => $item['product_name'],
                    'product_link'      => $item['product_link'] ?: null,
                    'quantity'          => $item['quantity'],
                    'weight_kg'         => $item['weight_kg'],
                ]);
            }

            session()->flash('success', 'Your assisted order has been submitted successfully.');

            return redirect()->route('assisted.thankyou');

        } catch (\Exception $e) {
            // In production → log it
            \Log::error('Assisted order submission failed', [
                'error' => $e->getMessage(),
                'data'  => $this->all(),
            ]);

            $this->addError('submit', 'Something went wrong. Please try again or contact support.');
        }

        return redirect()->route('assisted.thankyou');
    }

    public function render()
    {
        return view('livewire.frontend.assisted-order-form');
    }
}
