<?php

namespace Njoguamos\LaravelZohoOauth;

use Illuminate\Support\ServiceProvider;
use Njoguamos\LaravelZohoOauth\Console\ZohoOauthInitCommand;
use Njoguamos\LaravelZohoOauth\Console\ZohoOauthPruneCommand;

class ZohoOauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerPublishables();
        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zoho-oauth.php', 'zoho-oauth');

        $this->app->singleton('zoho-oauth', function () {
            return new ZohoOauth;
        });

        $this->app->bind(ZohoInit::class, function ($app) {
            $config = $app['config']->get('zoho-oauth');

            return new ZohoInit(
                new ZohoCredentials($config['base_oauth_url'], $config['client_id'], $config['client_secret'], $config['code'])
            );
        });

        $this->registerCommands();
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

    protected function registerCommands(): void
    {
        $this->app->bind('command.zoauth:init', ZohoOauthInitCommand::class);
        $this->app->bind('command.zoauth:prune', ZohoOauthPruneCommand::class);

        $this->commands([
            'command.zoauth:init',
            'command.zoauth:prune',
        ]);
    }
}
