<?php

namespace Njoguamos\LaravelZohoOauth\Console;

use Illuminate\Console\Command;
use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;
use Njoguamos\LaravelZohoOauth\ZohoInit;

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
        $responseData = app(ZohoInit::class)->getAuthorizationCode()->json();

        if (array_key_exists('error', $responseData)) {
            $this->warn($this->getErrorDescription($responseData['error']));

            return 0;
        }

        ZohoOauth::create($this->getData($responseData));

        $this->info('Successfully saved authorization codes to the database.');

        return 0;
    }

    protected function getErrorDescription(string $error)
    {
        switch ($error) {
            case 'invalid_code':
                return "Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.";
                break;
            case 'invalid_client':
                return 'You have passed an invalid Client ID or secret. Specify the correct client ID and secret.';
                break;
            default:
                echo "An error occurred - {$error}";
        }
    }

    protected function getData($jsonData): array
    {
        return [
            'access_token'  => $jsonData['access_token'],
            'refresh_token' => $jsonData['refresh_token'],
            'api_domain'    => $jsonData['api_domain'],
            'token_type'    => $jsonData['token_type'],
            'expires_at'    => now()->addSeconds($jsonData),
        ];
    }
}
