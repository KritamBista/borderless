<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Quote extends Model
{
    //
     protected $fillable = [
        'user_id',
        'country_id',

        'currency_code_snapshot',
        'exchange_rate_to_npr_snapshot',
        'shipping_rate_per_kg_snapshot',
        'service_fee_npr_snapshot',
        'vat_rate_snapshot',

        'items_cost_npr_total',
        'shipping_npr_total',
        'cif_npr_total',
        'duty_npr_total',
        'vat_npr_total',
        'grand_total_npr',

        'status',
    ];

    protected $casts = [
        'exchange_rate_to_npr_snapshot' => 'decimal:4',
        'shipping_rate_per_kg_snapshot' => 'decimal:2',
        'service_fee_npr_snapshot' => 'decimal:2',
        'vat_rate_snapshot' => 'decimal:4',

        'items_cost_npr_total' => 'decimal:2',
        'shipping_npr_total' => 'decimal:2',
        'cif_npr_total' => 'decimal:2',
        'duty_npr_total' => 'decimal:2',
        'vat_npr_total' => 'decimal:2',
        'grand_total_npr' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }
}
