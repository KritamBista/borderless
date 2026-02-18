<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Company;

class Home extends Component
{
    public $company;
    public function mount()
    {
        $this->company = Company::first();
    }
    public function render()
    {
        return view('livewire.frontend.home', ['company' => $this->company]);
    }
}
