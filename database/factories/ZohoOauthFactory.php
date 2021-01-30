<?php

namespace Njoguamos\LaravelZohoOauth\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;

class ZohoOauthFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ZohoOauth::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'refresh_token' => Str::random(32),
            'access_token'  => Str::random(40),
            'expires_in'    => Carbon::now()->addMinutes(50)
        ];
    }
}
