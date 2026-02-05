<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $table = 'customers';

    // WAJIB: Beritahu Laravel kalau primary key-nya bukan 'id'
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'name',
        'contact',
        'email',
        'password',
        'referral_code',
        'referred_by', // Penting untuk sistem komisi
        'otp_code',
        'otp_expiry'
    ];

    /**
     * Identitas JWT
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Logic Otomatis saat Create data
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($customer) {
            // 1. Generate Kode Referral Unik jika belum ada
            if (!$customer->referral_code) {
                $customer->referral_code = 'DELTA' . strtoupper(substr(uniqid(), -5));
            }
        });
    }
}
