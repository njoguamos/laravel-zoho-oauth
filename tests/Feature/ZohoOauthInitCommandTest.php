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

        $this->url = config('zoho-oauth.base_oauth_url').'/oauth/v2/token';
    }

    /** @test */
    public function it_catches_invalid_code_error()
    {
        config()->set('zoho-oauth.code', null);

        Http::fake([
            $this->url => Http::response(["error" => "invalid_code",], 200)
        ]);

        $this->artisan('zoauth:init')
            ->expectsOutput("Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.");
    }

    /** @test */
    public function it_catches_invalid_client_error()
    {
        config()->set('zoho-oauth.client_id', null);

        Http::fake([
            $this->url => Http::response(["error" => "invalid_client",], 200)
        ]);

        $this->artisan('zoauth:init')
            ->expectsOutput("You have passed an invalid Client ID or secret. Specify the correct client ID and secret.");
    }
}
