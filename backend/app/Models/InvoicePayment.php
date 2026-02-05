<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    // Nama tabel sesuai screenshot database atasan
    protected $table = 'invoice_payments';

    protected $fillable = [
        'invoice_id',
        'payment_method', // Contoh: 'Bank Transfer', 'E-Wallet'
        'amount_paid',
        'payment_date',
        'status' // Contoh: 'pending', 'success', 'failed'
    ];

    /**
     * Relasi balik ke Invoice
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
