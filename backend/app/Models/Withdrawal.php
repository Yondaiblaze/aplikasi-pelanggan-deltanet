<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'customer_id',
        'amount',
        'bank_name',
        'account_number',
        'status' // Misal: pending, success, rejected
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
