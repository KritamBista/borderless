<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
// use Livewire\WithPagination;
class MyOrders extends Component
{

 use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $status = '';

    protected $updatesQueryString = ['search', 'status'];
   public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->when($this->search, function ($q) {
                $q->where('unique_order_id', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })
            ->latest()
            ->paginate(8);

        return view('livewire.frontend.my-orders', [
            'orders' => $orders
        ])->layout('layouts.dashboard');
    }
}
