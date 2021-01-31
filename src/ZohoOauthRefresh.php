<?php

namespace Njoguamos\LaravelZohoOauth;

use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;

class ZohoOauthRefresh extends ZohoCredentials implements ZohoCredentialsInterface
{
    public function generateNewRefreshToken()
    {
        if (ZohoOauth::count() === 0) {
            return trans('zoauth::zoauth.no_refresh_token');
        }

        $responseData = $this->makeRequestToZohoAccounts($this->getRefreshCredentials());

        if (array_key_exists('error', $responseData)) {
            return $this->getErrorDescription($responseData['error']);
        }

        $this->saveTokensToDb($this->prepareData($responseData));

        return 'Successfully saved authorization codes to the database.';
    }

    public function prepareData(array $responseData): array
    {
        return [
            'access_token'  => $responseData['access_token'],
            'refresh_token' => $this->getRefreshToken(),
            'api_domain'    => $responseData['api_domain'],
            'token_type'    => $responseData['token_type'],
            'expires_at'    => now()->addSeconds($responseData['expires_in']),
        ];
    }
}
