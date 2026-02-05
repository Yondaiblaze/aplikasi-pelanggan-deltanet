<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    // Nama tabel sesuai screenshot database atasan
    protected $table = 'invoice_products';

    protected $fillable = [
        'invoice_id',
        'product_id',   // Pastikan ini ada
        'product_name',
        'product_type',
        'quantity',
        'price',
        'tax',          // Pastikan ini ada
        'discount',     // Pastikan ini ada
        'description'
    ];
    /**
     * Relasi balik ke Invoice
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
