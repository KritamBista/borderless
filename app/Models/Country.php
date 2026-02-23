<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
 protected $fillable = [
        'name',
        'flag',
        'code',
        'currency_code',
        'exchange_rate_to_npr',
        'shipping_rate_per_kg',
        'service_fee_npr',
        'min_chargeable_weight_kg',
        'is_active',
    ];

    protected $casts = [
        'exchange_rate_to_npr' => 'decimal:4',
        'shipping_rate_per_kg' => 'decimal:2',
        'service_fee_npr' => 'decimal:2',
        'min_chargeable_weight_kg' => 'decimal:3',
        'is_active' => 'boolean',
    ];

}
