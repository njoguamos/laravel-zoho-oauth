<?php

namespace Njoguamos\LaravelZohoOauth;

class ZohoCredentials
{
    const END_POINT = 'oauth/v2/token';
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;
    protected string $code;

    public function __construct(string $baseUrl, string $clientId, string $clientSecret, string $code)
    {
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->code = $code;
    }

    public function getEndPointUrl(): string
    {
        return $this->baseUrl.self::END_POINT;
    }

    public function getRequestBody(): array
    {
        return [
            'code'          => $this->code,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
    }
}