<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSession extends Model
{
    protected $table = 'customer_sessions';

    protected $fillable = [
        'customer_id',
        'token',
        'ip_address',
        'user_agent',
        'last_activity_at',
        'logged_out_at'
    ];

    protected $casts = [
        'last_activity_at' => 'datetime',
        'logged_out_at' => 'datetime'
    ];

    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get active sessions only
     */
    public function scopeActive($query)
    {
        return $query->whereNull('logged_out_at');
    }

    /**
     * Mark session as logged out
     */
    public function logout()
    {
        return $this->update(['logged_out_at' => now()]);
    }

    /**
     * Update last activity time
     */
    public function updateActivity()
    {
        return $this->update(['last_activity_at' => now()]);
    }
}
