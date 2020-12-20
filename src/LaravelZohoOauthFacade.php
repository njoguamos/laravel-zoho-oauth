<?php

namespace Njoguamos\LaravelZohoOauth;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Njoguamos\LaravelZohoOauth\Skeleton\SkeletonClass
 */
class LaravelZohoOauthFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-zoho-oauth';
    }
}
