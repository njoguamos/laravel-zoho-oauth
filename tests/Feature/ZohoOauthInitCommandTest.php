<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthInitCommandTest extends TestCase
{
    /** @test */
    public function it_returns_invalid_code_when_code_is_null()
    {
        config()->set('zoho-oauth.code', null);

        Http::fake([
            config('zoho-oauth.base_oauth_url').'/oauth/v2/token' => Http::response(["error" => "invalid_code",], 200)
        ]);

        $this->artisan('zoauth:init')
            ->expectsOutput($this->getInvalidCodeError());
    }

    protected function getInvalidCodeError()
    {
        return "Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.";
    }
}
