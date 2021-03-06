<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Feature;

use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthInitCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_saves_authorization_tokens_to_database_on_success_response()
    {
        $successResponse = [
            'access_token'  => '1000.5e0cd91a9e79ae7f35d4ca73a5cce204.cfc90960373093f903e509619b9ea088',
            'refresh_token' => '1000.69be61cb69415ec9c945b16fd7767814.54cccb3b531121ba6e82ec94ddbd2339',
            'api_domain'    => 'https://www.zohoapis.com',
            'token_type'    => 'Bearer',
            'expires_in'    => 3600,
        ];

        $this->mockASuccessfulResponse($successResponse);

        $this->artisan('zoauth:init')
            ->expectsOutput(trans('zoauth::zoauth.successful_save'));

        $this->assertDatabaseHas('zoho_oauth', [
            'access_token'  => $successResponse['access_token'],
            'refresh_token' => $successResponse['refresh_token'],
            'api_domain'    => $successResponse['api_domain'],
            'token_type'    => $successResponse['token_type'],
        ]);
    }

    /** @test */
    public function it_catches_invalid_code_error()
    {
        $this->mockFakeErrorResponse('invalid_code');

        $this->artisan('zoauth:init')
            ->expectsOutput(trans('zoauth::zoauth.invalid_code'));
    }

    /** @test */
    public function it_catches_invalid_client_error()
    {
        $this->mockFakeErrorResponse('invalid_client');

        $this->artisan('zoauth:init')
            ->expectsOutput(trans('zoauth::zoauth.invalid_client'));
    }
}
