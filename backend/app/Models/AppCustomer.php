<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject; // Pastikan sudah pakai 'use'

class AppCustomer extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * PERBAIKAN DISINI:
     * Daftarkan kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'name',
        'contact',
        'email',
        'password',
        'referral_code',
        'referral_id',
        'otp_code',
        'otp_expiry'
    ];

    /**
     * Properti lainnya tetap sama...
     */
    protected $hidden = [
        'password',
    ];

    // Fungsi JWT jangan sampai dihapus
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
