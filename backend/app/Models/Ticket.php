<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets'; // Pastikan nama tabel di DB sesuai

    protected $fillable = [
        'customer_id',
        'subject',      // Contoh: "Internet Mati"
        'description',  // Penjelasan detail kendala
        'category',     // Contoh: "Teknis", "Tagihan"
        'priority',     // Contoh: "Low", "Medium", "High"
        'status'        // Contoh: "open", "in_progress", "resolved", "closed"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
