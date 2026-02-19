<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = [
        'unique_order_id',
        'user_id',
        'quote_id',
        'address_id',
        'payment_method_id',
        'payment_proof_path',
        'payment_proof_uploaded',
        'grand_total_npr',
        'discount_npr',
        'payable_npr',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'payment_proof_uploaded' => 'boolean',
        'grand_total_npr' => 'decimal:2',
        'discount_npr' => 'decimal:2',
        'payable_npr' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->unique_order_id = self::generateUniqueOrderId();
        });
    }

    private static function generateUniqueOrderId(): string
    {
        $year = now()->year;

        $last = self::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->first();

        $nextNumber = $last ? ((int)substr($last->unique_order_id, -5)) + 1 : 1;

        return 'ORD-' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
