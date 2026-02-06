<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // WAJIB: Kasih tahu Laravel kalau model ini pakai tabel app_customers
    protected $table = 'app_customers';

    /**
     * Daftarkan kolom yang boleh diisi (Mass Assignable)
     */
    protected $fillable = [
        'name',
        'contact',    // Pakai 'contact' sesuai database, bukan 'phone'
        'password',
        'referral_code',
        'referral_id', // Tambahkan ini agar sistem referral jalan
        'otp_code',
        'otp_expiry'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi untuk melihat siapa pengajaknya (Parent)
     */
    public function inviter()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }

    /**
     * Relasi untuk melihat siapa saja yang diajak (Children)
     * Contoh: Daiva punya banyak bawahan (Yondai, dll)
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referral_id');
    }
}
