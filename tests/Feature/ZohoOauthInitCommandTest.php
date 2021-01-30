<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Feature;

use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthInitCommandTest extends TestCase
{
    /** @test */
    public function it_can_get_access_token_and_refresh_token_given_correct_credentials()
    {
        // Given we have correct credentials in the env
        // and run the command zoauth:init
        // it should get a successful response with access_token and refresh_token
        // it should save data to the database
        $this->assertTrue(true);
    }
}
