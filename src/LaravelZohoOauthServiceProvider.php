<?php

namespace Njoguamos\LaravelZohoOauth;

use Illuminate\Support\ServiceProvider;

class LaravelZohoOauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-zoho-oauth.php' => config_path('laravel-zoho-oauth.php'),
            ], 'config');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-zoho-oauth.php', 'laravel-zoho-oauth');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-zoho-oauth', function () {
            return new LaravelZohoOauth;
        });
    }
}
