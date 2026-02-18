<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteItem extends Model
{
    //
     protected $fillable = [
        'quote_id',
        'product_category_id',

        'product_name',
        'product_link',
        'unit_price_foreign',
        'quantity',
        'weight_kg',

        'duty_rate_snapshot',

        'item_cost_npr',
        'shipping_cost_npr',
        'cif_npr',
        'duty_npr',
        'vat_npr',
        'total_npr',
    ];

    protected $casts = [
        'unit_price_foreign' => 'decimal:2',
        'weight_kg' => 'decimal:3',
        'duty_rate_snapshot' => 'decimal:4',

        'item_cost_npr' => 'decimal:2',
        'shipping_cost_npr' => 'decimal:2',
        'cif_npr' => 'decimal:2',
        'duty_npr' => 'decimal:2',
        'vat_npr' => 'decimal:2',
        'total_npr' => 'decimal:2',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
