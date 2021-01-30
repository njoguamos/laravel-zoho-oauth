<?php

namespace Njoguamos\LaravelZohoOauth;

use Illuminate\Support\Facades\Http;

class ZohoInit
{
    protected ZohoCredentials $credentials;

    public function __construct(ZohoCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getAuthorizationCode()
    {
        return Http::asForm()
            ->post(
                $this->credentials->getEndPointUrl(),
                array_merge($this->credentials->getRequestBody(), ['grant_type' => 'authorization_code'])
            );
    }
}
