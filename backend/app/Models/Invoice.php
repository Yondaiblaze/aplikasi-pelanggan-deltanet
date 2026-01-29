<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // Jika nama tabelnya bukan 'invoices', tentukan di sini
    protected $table = 'invoices';

    public function customer()
    {
        // Menghubungkan invoice ke customer
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
