<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Order;

class OrderDetails extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $this->order = $order->load(['address', 'paymentMethod']);
    }

    public function render()
    {
        return view('livewire.frontend.order-details')
            ->layout('layouts.dashboard');
    }
}
