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
         $relatedBlogs = Blog::query()
            ->where('is_published', true)
            ->whereKeyNot($this->blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        return view('livewire.frontend.blog-show', [
            'blog' => $this->blog,
             'relatedBlogs' => $relatedBlogs,
        ])->layout('layouts.app');
    }
}
