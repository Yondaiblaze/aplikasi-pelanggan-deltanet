<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'user_id',
        'referred_user_id', 
        'referral_code',
        'amount',
        'status',
        'invoice_id',
        'earned_date'
    ];

    protected $casts = [
        'earned_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function referredUser()
    {
        return $this->belongsTo(Customer::class, 'referred_user_id');
    }
}