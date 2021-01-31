<?php

namespace Njoguamos\LaravelZohoOauth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZohoOauth extends Model
{
    use HasFactory;

    protected $table = 'zoho_oauth';

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $guarded = [];

    protected $appends = [
        'auth_token', 'is_expired',
    ];

    protected function getAuthTokenAttribute()
    {
        return "Zoho-oauthtoken {$this->access_token}";
    }

    protected function getIsExpiredAttribute()
    {
        return $this->expires_at->isPast();
    }
}
