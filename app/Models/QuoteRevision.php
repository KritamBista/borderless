<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRevision extends Model
{
    //
      protected $fillable = [
        'quote_id',
        'user_id',
        'contact_name',
        'contact_email',
        'contact_phone',
        'reason',
    ];
       public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
