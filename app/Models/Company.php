<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
     protected $fillable = [
        'name',
        'logo',
        'preview_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'hero_title',
        'hero_description',
        'vat_percent',
        'is_active',
    ];

    protected $casts = [
        'vat_percent' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
