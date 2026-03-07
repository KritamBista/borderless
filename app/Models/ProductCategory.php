<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'duty_rate',
        'is_vat_applicable',
        'is_active',
    ];

}
