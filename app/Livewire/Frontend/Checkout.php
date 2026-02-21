<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Quote;
use App\Models\Address;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    use WithFileUploads;

    public Quote $quote;

    public int $step = 1;

    // Address fields
    public string $full_name = '';
    public string $phone = '';
    public string $province = '';
    public string $city = '';
    public string $area = '';
    public string $address_line = '';
    public string $postal_code = '';

    // Payment
    public ?int $payment_method_id = null;
    public $payment_proof;

    public function mount(string $public_id)
    {
        $quote = Quote::where('public_id', $public_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (Order::where('quote_id', $quote->id)->exists()) {
            abort(403, 'Order already created.');
        }

        $this->quote = $quote;

        $this->full_name = auth()->user()->name;
        $this->phone = auth()->user()->phone ?? '';
    }

    public function nextStep()
    {
        $this->validate([
            'full_name' => 'required|min:2',
            'phone' => 'required|min:7',
            'province' => 'required',
            'city' => 'required',
            'address_line' => 'required|min:5',
        ]);

        $this->step = 2;
    }

    public function backStep()
    {
        $this->step = 1;
    }

    public function placeOrder()
    {
        $this->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        DB::transaction(function () {

            // Save Address
            $address = Address::create([
                'user_id' => auth()->id(),
                'full_name' => $this->full_name,
                'phone' => $this->phone,
                'province' => $this->province,
                'city' => $this->city,
                'area' => $this->area,
                'address_line' => $this->address_line,
                'postal_code' => $this->postal_code,
            ]);

            // Upload payment proof
            $path = $this->payment_proof->store('payment-proofs', 'public');

            // Create Order
            Order::create([
                'user_id' => auth()->id(),
                'quote_id' => $this->quote->id,
                'address_id' => $address->id,
                'payment_method_id' => $this->payment_method_id,
                'payment_proof_path' => $path,
                'payment_proof_uploaded' => true,
                'grand_total_npr' => $this->quote->grand_total_npr,
                'discount_npr' => $this->quote->discount_npr ?? 0,
                'payable_npr' => $this->quote->payable_npr,
                'status' => 'pending_verification',
            ]);
        });

        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('order.success'); // or order success page
    }

    public function render()
    {
        return view('livewire.frontend.checkout', [
            'paymentMethods' => PaymentMethod::where('is_active', true)->get(),
        ]);
    }
}
