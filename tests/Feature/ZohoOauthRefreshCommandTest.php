<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Feature;

use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;
use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthRefreshCommandTest extends TestCase
{
    protected $existingTokens;

    public function setUp(): void
    {
        parent::setUp();

        $this->existingTokens = ZohoOauth::factory()->create();
    }

    /** @test */
    public function it_cannot_get_access_token_without_refresh_token()
    {
        ZohoOauth::truncate();

        $this->artisan('zoauth:refresh')
            ->expectsOutput(trans('zoauth::zoauth.no_refresh_token'))
            ->assertExitCode(0);

        $this->assertSame(ZohoOauth::count(), 0);
    }

    /** @test */
    public function it_saves_access_tokens_to_database_on_success_response()
    {
        $successResponse = [
            "access_token" => "1000.27c1b6b28ac001d410f06c41f4fc5d5a.8f461e4c2cc966e8aaccba8f34fca395",
            "api_domain"   => "https://www.zohoapis.com",
            "token_type"   => "Bearer",
            "expires_in"   => 3600,
        ];

        $this->mockASuccessfulResponse($successResponse);

        $this->artisan('zoauth:refresh')
            ->expectsOutput(trans('zoauth::zoauth.successful_save'));

        $this->assertDatabaseHas('zoho_oauth', [
            'refresh_token' => $this->existingTokens->refresh_token,
            'access_token'  => $successResponse['access_token'],
            'api_domain'    => $successResponse['api_domain'],
            'token_type'    => $successResponse['token_type'],
        ]);
    }

    /** @test */
    public function it_catches_invalid_code_error()
    {
        $this->mockFakeErrorResponse('invalid_code');

        $this->artisan('zoauth:refresh')
            ->expectsOutput(trans('zoauth::zoauth.invalid_code'));
    }

    /** @test */
    public function it_catches_invalid_client_error()
    {
        $this->mockFakeErrorResponse('invalid_client');

        $this->artisan('zoauth:refresh')
            ->expectsOutput(trans('zoauth::zoauth.invalid_client'));
    }
}
