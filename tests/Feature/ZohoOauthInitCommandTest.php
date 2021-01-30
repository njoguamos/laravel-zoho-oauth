<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthInitCommandTest extends TestCase
{
    protected string $url;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = config('zoho-oauth.base_oauth_url').'oauth/v2/token';
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

        $this->mockFakeErrorResponse('invalid_code');

        $this->artisan('zoauth:init')
            ->expectsOutput('Successfully saved authorization codes to the database.');

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
            ->expectsOutput("Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.");
    }

    /** @test */
    public function it_catches_invalid_client_error()
    {
        $this->mockFakeErrorResponse('invalid_client');

        $this->artisan('zoauth:init')
            ->expectsOutput('You have passed an invalid Client ID or secret. Specify the correct client ID and secret.');
    }

    protected function mockFakeErrorResponse(string $error, int $status = 200)
    {
        return Http::fake([$this->url => Http::response(['error' => $error], $status)]);
    }

    protected function mockASuccessfulResponse(array $reponse)
    {
        return Http::fake([$this->url => Http::response($reponse, 200)]);
    }
}
