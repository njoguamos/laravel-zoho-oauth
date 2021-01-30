<?php

namespace Njoguamos\LaravelZohoOauth;

use Illuminate\Support\Facades\Facade;

class ZohoOauthFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zoho-oauth';
    }
}
