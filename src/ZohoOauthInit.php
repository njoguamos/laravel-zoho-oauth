<?php

namespace Njoguamos\LaravelZohoOauth;

class ZohoOauthInit extends ZohoCredentials implements ZohoCredentialsInterface
{
    public function initializeTokens()
    {
        $responseData = $this->makeRequestToZohoAccounts($this->getInitCredentials());

        if (array_key_exists('error', $responseData)) {
            return $this->getErrorDescription($responseData['error']);
        }

        $this->saveTokensToDb($this->prepareData($responseData));

        return trans('zoauth::zoauth.successful_save');
    }

    public function prepareData($responseData): array
    {
        return [
            'access_token'  => $responseData['access_token'],
            'refresh_token' => $responseData['refresh_token'],
            'api_domain'    => $responseData['api_domain'],
            'token_type'    => $responseData['token_type'],
            'expires_at'    => now()->addSeconds($responseData['expires_in']),
        ];
    }
}
