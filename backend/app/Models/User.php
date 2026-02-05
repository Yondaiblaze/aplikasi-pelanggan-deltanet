<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject; // Wajib untuk JWT

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    // Arahkan ke tabel pelanggan yang diberikan atasan
    protected $table = 'customers';

    // Primary key di tabel kamu bukan 'id', tapi 'customer_id'
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'name', 'email', 'contact', 'password', 'referral_code', 'referred_by'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Wajib ditambahkan untuk JWT-Auth agar bisa generate Token
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
