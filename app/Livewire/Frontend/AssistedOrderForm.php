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
        $this->countries = Country::orderBy('name')->get();

        $this->items[] = [
            'product_name' => '',
            'product_link' => '',
            'quantity'     => 1,
            'weight_kg'    => '',
        ];
    }

    protected function rules()
    {
        return [
            'country_id'                 => 'required|exists:countries,id',
            'contact_name'               => 'required|string|max:255',
            'contact_email'              => 'required|email|max:255',
            'contact_phone'              => 'nullable|string|max:50',

            'items'                      => 'required|array|min:1',
            'items.*.product_name'       => 'required|string|max:255',
            'items.*.product_link'       => 'nullable|url',
            'items.*.quantity'           => 'required|integer|min:1',
            'items.*.weight_kg'          => 'required|numeric|min:0.01',
        ];
    }

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
        // dd('here');
            // dd($this->country_id['id']);

        // dd($this->items);
        // $this->validate();
            // dd('jere');
        $order = AssistedOrder::create([
            // 'user_id'       => auth()->id() ?? "",
            'country_id'    => $this->country_id['id'],
            'contact_name'  => $this->contact_name,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'status'        => 'submitted',
        ]);


        foreach ($this->items as $item) {
            AssistedOrderItem::create([
                'assisted_order_id' => $order->id,
                'product_name'      => $item['product_name'],
                'product_link'      => $item['product_link'],
                'quantity'          => $item['quantity'],
                'weight_kg'         => $item['weight_kg'],
            ]);
        }

        session()->flash('success', 'Your assisted order has been submitted successfully.');

        return redirect()->route('assisted.thankyou');
    }

    public function render()
    {
        return view('livewire.frontend.assisted-order-form');
    }
}
