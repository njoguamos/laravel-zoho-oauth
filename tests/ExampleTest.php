<?php

namespace Njoguamos\LaravelZohoOauth\Tests;

use Orchestra\Testbench\TestCase;
use Njoguamos\LaravelZohoOauth\LaravelZohoOauthServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelZohoOauthServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
