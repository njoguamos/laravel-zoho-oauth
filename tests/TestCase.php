<?php

namespace Njoguamos\LaravelZohoOauth\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Njoguamos\LaravelZohoOauth\ZohoOauthRefresh;
use Njoguamos\LaravelZohoOauth\ZohoOauthServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected $url;

    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Njoguamos\\LaravelZohoOauth\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->url = app(ZohoOauthRefresh::class)->getEndPointUrl();
    }

    protected function getPackageProviders($app)
    {
        return [
            ZohoOauthServiceProvider::class,
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

        config()->set('zoho-oauth', [
            'base_oauth_url' => 'https://accounts.zoho.com',
            'client_id'      => Str::random(32),
            'client_secret'  => Str::random(32),
            'code'           => Str::random(45),
        ]);

        include_once __DIR__.'/../database/migrations/create_zoho_oauth_table.php.stub';
        (new \CreateZohoOauthTable())->up();
    }

    protected function mockFakeErrorResponse(string $error, int $status = 200)
    {
        return Http::fake([$this->url => Http::response(['error' => $error], $status)]);
    }

    protected function mockASuccessfulResponse(array $reponse)
    {
        Http::fake([$this->url => Http::response($reponse, 200)]);
    }
}
