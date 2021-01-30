<?php

namespace Njoguamos\LaravelZohoOauth\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Njoguamos\LaravelZohoOauth\LaravelZohoOauthServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Njoguamos\\LaravelZohoOauth\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelZohoOauthServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        config()->set('laravel-zoho-oauth', [
            'client_id'     => Str::random(32),
            'client_secret' => Str::random(32),
            'code'          => Str::random(45),
        ]);

        include_once __DIR__.'/../database/migrations/create_zoho_oauth_table.php.stub';
        (new \CreateZohoOauthTable())->up();
    }
}
