<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Unit;

use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;
use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthTest extends TestCase
{
    /** @test */
    public function it_can_return_auth_token_attribute()
    {
        $token = ZohoOauth::factory()->create([
            'refresh_token' => '1000.41d9f2cfbd1b7a8f9e314b7aff7bc2d1.8fcc9810810a216793f385b9dd6e125f',
        ]);

        $this->assertSame($token->auth_token, 'Zoho-oauthtoken 1000.41d9f2cfbd1b7a8f9e314b7aff7bc2d1.8fcc9810810a216793f385b9dd6e125f');
    }

    /** @test */
    public function it_can_determine_if_a_token_is_expired()
    {
        $expiredToken = ZohoOauth::factory()->expired()->create();
        $validToken = ZohoOauth::factory()->valid()->create();

        $this->assertTrue($expiredToken->is_expired);
        $this->assertFalse($validToken->is_expired);
    }
}
