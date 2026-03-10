<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Order;

class OrderDetails extends Component
{

    public $customer_review;


    public Order $order;

    public function mount(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $this->order = $order->load(['address', 'paymentMethod']);
    }
        public function submitReview()
    {
        $this->validate([
            'customer_review' => 'required|min:5|max:2000'
        ]);

        $this->order->update([
            'customer_review' => $this->customer_review
        ]);

        session()->flash('success', 'Thank you! Your review has been submitted.');
    }

    public function render()
    {
        return view('livewire.frontend.order-details')
            ->layout('layouts.dashboard');
    }
}
