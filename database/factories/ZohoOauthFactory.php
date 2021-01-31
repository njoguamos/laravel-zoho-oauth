<?php

namespace Njoguamos\LaravelZohoOauth\Database\Factories;

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
            'expires_at'    => now()->addMinutes(50),
        ];
    }

    /**
     * Indicate if a token is recent.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function recent()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => now()->subMinutes(rand(1, 60)),
            ];
        });
    }

    /**
     * Indicate if a token is old.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function old()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => now()->subDays(rand(4, 10)),
            ];
        });
    }

    /**
     * Indicate if a token is valid.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function valid()
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => now()->addMinutes(rand(20, 50)),
            ];
        });
    }

    /**
     * Indicate if a token is expired.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function expired()
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => now()->subMinutes(rand(20, 50)),
            ];
        });
    }
}
