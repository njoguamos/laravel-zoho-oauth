<?php

namespace Njoguamos\LaravelZohoOauth\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ZohoOauthInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zoauth:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize Zoho oauth refresh_token and access_token.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::asForm()
            ->post(config('zoho-oauth.base_oauth_url').'/oauth/v2/token', [
                'code'          => config('zoho-outh.code'),
                'client_id'     => config('zoho-outh.client_id'),
                'client_secret' => config('zoho-outh.client_secret'),
                'grant_type'    => 'authorization_code'
            ]);

        $data = $response->json();

        if (array_key_exists('error', $data)) {
            $this->warn($this->getErrorDescription($data['error']));

            return 0;
        }

        // Data okay let us continue

        return 0;
    }

    protected function getErrorDescription(string $error)
    {
        switch ($error) {
            case 'invalid_code':
                return "Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.";
                break;
            default:
                echo "An error occured - {$error}";
        }
    }
}
