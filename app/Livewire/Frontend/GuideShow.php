<?php

namespace App\Livewire\Frontend;

use App\Models\Guide;
use Livewire\Component;

class GuideShow extends Component
{
    public Guide $guide;

    public function mount(Guide $guide)
    {
        if (!$guide->is_published) {
            abort(404);
        }
        $this->guide = $guide;
    }

    public function render()
    {
        return view('livewire.frontend.guide-show', [
            'guide' => $this->guide,
        ])->layout('layouts.app');
    }
}
