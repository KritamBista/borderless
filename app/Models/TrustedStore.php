<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrustedStore extends Model
{
    //
     protected $fillable = [
        'name',
        'logo',
        'link',
        'is_active',
        'sort_order',
    ];
}
