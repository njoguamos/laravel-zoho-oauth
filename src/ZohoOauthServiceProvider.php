<?php

namespace Njoguamos\LaravelZohoOauth;

use Illuminate\Support\ServiceProvider;
use Njoguamos\LaravelZohoOauth\Console\ZohoOauthInitCommand;
use Njoguamos\LaravelZohoOauth\Console\ZohoOauthPruneCommand;
use Njoguamos\LaravelZohoOauth\Console\ZohoOauthRefreshCommand;

class ZohoOauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerPublishables();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/zoho-oauth.php' => config_path('zoho-oauth.php'),
            ], 'config');

            if (! class_exists('CreateZohoOauthTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_zoho_oauth_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_zoho_oauth_table.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/zoho-oauth.php', 'zoho-oauth'
        );

        $this->loadTranslationsFrom(
            __DIR__.'/../resources/lang/', 'zoauth'
        );

        $this->app->bind(ZohoOauthInit::class, function ($app) {
            $config = $app['config']->get('zoho-oauth');

            return new ZohoOauthInit($config['base_oauth_url'], $config['client_id'], $config['client_secret'], $config['code'], $config['redirect_uri']);
        });

        $this->app->bind(ZohoOauthRefresh::class, function ($app) {
            $config = $app['config']->get('zoho-oauth');

            return new ZohoOauthRefresh($config['base_oauth_url'], $config['client_id'], $config['client_secret'], $config['code'], $config['redirect_uri']);
        });

        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ZohoOauthInitCommand::class,
                ZohoOauthRefreshCommand::class,
                ZohoOauthPruneCommand::class,
            ]);
        }
    }
}
