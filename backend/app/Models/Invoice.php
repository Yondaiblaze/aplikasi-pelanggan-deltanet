<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // Nama tabel di database
    protected $table = 'invoices';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
    'invoice_id',   // Sesuai DB
    'customer_id',
    'issue_date',   // Gunakan issue_date sebagai tanggal tagihan
    'due_date',     // Tanggal jatuh tempo
    'amount',       // Tidak ada di tabel invoice, ambil dari total di invoice_products?
                    // Sementara simpan di sini jika kolomnya ada, jika tidak, kita hitung dinamis.
    'status'        // Di DB tipenya int (0/1)
];

    /**
     * Relasi ke User/Customer
     * Menghubungkan invoice kembali ke pemiliknya
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relasi ke tabel invoice_products
     * Satu invoice bisa memiliki banyak item produk (internet, admin, dsb)
     */
    public function products()
    {
        // Pastikan file InvoiceProduct.php sudah ada di folder Models
        return $this->hasMany(InvoiceProduct::class, 'invoice_id');
    }

    /**
     * Relasi ke tabel invoice_payments
     * Satu invoice bisa memiliki riwayat pembayaran
     */
    public function payments()
    {
        // Pastikan file InvoicePayment.php sudah ada di folder Models
        return $this->hasMany(InvoicePayment::class, 'invoice_id');
    }
}
