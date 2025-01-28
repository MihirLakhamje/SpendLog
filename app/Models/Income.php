<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'user_id',
        'income_amount',
        'income_date',
        'source',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
