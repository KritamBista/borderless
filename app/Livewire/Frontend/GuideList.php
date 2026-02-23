<?php

namespace App\Livewire\Frontend;

use App\Models\Guide; // Change to your actual model namespace
use Livewire\Component;
use Livewire\WithPagination;

class GuideList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $category = ''; // Optional filter by category

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $guides = Guide::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%'))
            ->when($this->category, fn($q) => $q->where('category', $this->category))
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        // Optional: Get unique categories for dropdown/filter
        $categories = Guide::where('is_published', true)
            ->whereNotNull('category')
            ->distinct('category')
            ->pluck('category');

        return view('livewire.frontend.guide-list', [
            'guides' => $guides,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
