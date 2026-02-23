<?php

namespace App\Livewire\Frontend;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind'; // Uses Tailwind pagination by default in Livewire 3

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to page 1 when search changes
    }

    public function render()
    {
        $blogs = Blog::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->search . '%');
            })
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(9); // 9 per page for nice grid

        return view('livewire.frontend.blog-list', [
            'blogs' => $blogs,
        ])->layout('layouts.app'); // or your main layout
    }
}
