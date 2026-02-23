<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AssistedOrder extends Model
{
    //
     protected $fillable = [
        'user_id',
        'country_id',
        'contact_name',
        'contact_email',
        'contact_phone',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            do {
                $publicId = strtoupper(Str::random(10));
            } while (self::where('public_id', $publicId)->exists());

            $order->public_id = $publicId;
        });
    }

    public function items()
    {
        return $this->hasMany(AssistedOrderItem::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
