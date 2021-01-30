<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Unit;

use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;
use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthTest extends TestCase
{
    /** @test */
    public function it_can_get_the_latest()
    {
        ZohoOauth::factory()->create();

        dd(ZohoOauth::latest()->first());
        $this->assertTrue(true);
    }
}
