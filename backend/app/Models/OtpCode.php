<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    // Nama tabel di database
    protected $table = 'otp_codes';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'phone',
        'code',
        'type', // login, register, forgot_password
        'expired_at'
    ];

    // Mengaktifkan timestamps untuk fitur Anti-Spam (60 detik)
    public $timestamps = true;

    /**
     * Casting properti agar otomatis menjadi objek Carbon.
     * Ini memudahkan pengecekan 'expired_at' > Carbon::now()
     */
    protected $casts = [
        'expired_at' => 'datetime',
    ];
}
