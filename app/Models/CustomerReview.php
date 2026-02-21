<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    //
        protected $fillable = [
        'name',
        'destination',
        'stars',
        'review',
        'avatar',
        'is_active',
        'sort_order',
    ];
}
