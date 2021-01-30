<?php


namespace Njoguamos\LaravelZohoOauth\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZohoOauth extends Model
{
    use HasFactory;

    protected $table = 'zoho_oauth';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];

}