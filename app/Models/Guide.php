<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Guide extends Model
{
    //
     protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'category',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($guide) {
            if (!$guide->slug) {
                $guide->slug = Str::slug($guide->title);
            }
        });
    }
}
