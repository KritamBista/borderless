<?php

namespace App\Livewire\Frontend;

use App\Models\Blog;
use Livewire\Component;

class BlogShow extends Component
{
    public Blog $blog;

    public function mount(Blog $blog)
    {
        if (!$blog->is_published) {
            abort(404);
        }
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.frontend.blog-show', [
            'blog' => $this->blog,
        ])->layout('layouts.app');
    }
}
