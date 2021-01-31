<?php

namespace Njoguamos\LaravelZohoOauth\Console;

use Illuminate\Console\Command;
use Njoguamos\LaravelZohoOauth\ZohoOauthRefresh;

class ZohoOauthRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zoauth:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new access token from refresh token.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(app(ZohoOauthRefresh::class)->generateNewRefreshToken());

        return 0;
    }
}
