<?php

namespace Njoguamos\LaravelZohoOauth;

interface ZohoCredentialsInterface
{
    public function prepareData(array $responseData): array;
}
