<?php

namespace Njoguamos\LaravelZohoOauth\Tests\Feature;

use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;
use Njoguamos\LaravelZohoOauth\Tests\TestCase;

class ZohoOauthPruneCommandTest extends TestCase
{
    /** @test */
    public function it_cannot_prune_an_empty_database()
    {
        ZohoOauth::truncate();

        $this->artisan('zoauth:prune')
            ->expectsOutput(trans('zoauth::zoauth.db_empty'))
            ->assertExitCode(0);
    }

    /** @test */
    public function it_delete_all_tokens_except_the_latest_ten_records()
    {
        $latestTokens = ZohoOauth::factory()
            ->recent()->count(10)->create();

        $oldTokens = ZohoOauth::factory()
            ->old()->count(30)->create();

        $this->artisan('zoauth:prune')
            ->expectsOutput('Old tokens removed successfully')
            ->assertExitCode(0);

        $tokens = ZohoOauth::all();

        $this->assertDatabaseCount('zoho_oauth', 10);
        $latestTokens->each(fn ($oldToken) => $this->assertTrue($tokens->contains($oldToken)));
    }
}
