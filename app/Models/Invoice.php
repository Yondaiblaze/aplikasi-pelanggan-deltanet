<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    public $timestamps = true;
    
    protected $fillable = [
        'customer_id', 'amount', 'description', 'status', 'due_date', 'paid_at'
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
