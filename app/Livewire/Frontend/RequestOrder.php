<?php

namespace App\Livewire\Frontend;

use App\Models\Faq;
use Livewire\Component;

class RequestOrder extends Component
{
    public function render()
    {

        return view('livewire.frontend.request-order', [
        'faqs' => Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(),
    ]);
    }
}
