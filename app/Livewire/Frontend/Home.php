<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Company;
use App\Models\CustomerReview;
use App\Models\Faq;
use App\Models\HotProduct;
use App\Models\TrustedStore;

class Home extends Component
{
    public $company;
    public function mount()
    {
        $this->company = Company::first();
    }
    public function render()
    {
        $trustedStores = TrustedStore::where('is_active', true)->orderBy('sort_order')->get();

$reviews = CustomerReview::where('is_active', true)->orderBy('sort_order')->get();

$faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
$hotProducts = HotProduct::where('is_active', true)
    ->where('is_featured', true)
    ->orderBy('sort_order')
    ->get();
$company = Company::first();
        return view('livewire.frontend.home', [
            'company' => $this->company,
            'trustedStores' => $trustedStores,
            'reviews' => $reviews,
            'faqs' => $faqs,
            'hotProducts'=>$hotProducts
        ]);
    }
}
