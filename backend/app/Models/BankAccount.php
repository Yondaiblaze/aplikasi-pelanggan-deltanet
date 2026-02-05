<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'customer_id',
        'bank_name',
        'account_holder_name',
        'account_number',
        'account_type',
        'is_primary',
        'otp_verified',
        'verified_at'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'otp_verified' => 'boolean',
        'verified_at' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
