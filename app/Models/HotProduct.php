<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotProduct extends Model
{
    //
     protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'currency',
        'product_url',
        'origin_country',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
