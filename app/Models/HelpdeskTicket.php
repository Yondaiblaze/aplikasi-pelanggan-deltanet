<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpdeskTicket extends Model
{
    protected $table = 'helpdesk_tickets';
    protected $fillable = ['customer_id', 'subject', 'description', 'status'];
    public $timestamps = true;
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
