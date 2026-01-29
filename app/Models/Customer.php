<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// Tambahkan baris ini
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $table = 'customers';

    protected $fillable = [
        'name', 'contact', 'otp_code', 'otp_expiry'
    ];

    /**
     * Tambahkan fungsi ini untuk mendapatkan ID unik user
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Tambahkan fungsi ini untuk klaim kustom (bisa dikosongkan)
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
