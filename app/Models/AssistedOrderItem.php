<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistedOrderItem extends Model
{
    //
       protected $fillable = [
        'assisted_order_id',
        'product_name',
        'product_link',
        'quantity',
        'notes',
        'weight_kg',
    ];

    public function assistedOrder()
    {
        return $this->belongsTo(AssistedOrder::class);
    }
}
