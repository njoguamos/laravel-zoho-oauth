<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Zoho Base OAuth 2.0 Url
     |--------------------------------------------------------------------------
     |
     | Zoho Inventory is hosted at multiple data centers, and therefore available
     | on different domains. There are 4 different domains for Zoho Inventory's
     | APIs, and you will have to use the one that is applicable to you.
     | You must choose the appropriate domain for API endpoints.
     | These include:
     |
     | United States   =>  https://accounts.zoho.com/
     | Europe          =>  https://accounts.zoho.eu/
     | India           =>  https://accounts.zoho.in/
     | Australia       =>  https://accounts.zoho.com.au/
     |
     | Learn more at https://www.zoho.com/inventory/api/v1/#multidc
     |
     */
    'base_oauth_url' => env('BASE_OAUTH_URL', 'https://accounts.zoho.com'),

    /*
     |--------------------------------------------------------------------------
     | Zoho OAuth 2.0 Client ID
     |--------------------------------------------------------------------------
     |
     | The Client ID is a public identifier for apps. It is known to both Zoho
     | and your application. Visit https://accounts.zoho.com/developerconsole
     | and create a new self client. On successful registration you should
     | be provided with a Client ID and Client Secret.
     |
     */
    'client_id'      => env('ZOHO_CLIENT_ID'),

    /*
     |--------------------------------------------------------------------------
     | Zoho OAuth 2.0 Client Secret
     |--------------------------------------------------------------------------
     |
     | The Client Secret is known only to the application and the authorization
     | server. It is known to both Zoho and your application. I it is created
     | at the same time as Client ID.
     |
     */
    'client_secret'  => env('ZOHO_CLIENT_SECRET'),

    /*
     |--------------------------------------------------------------------------
     | Zoho OAuth 2.0 Grant Token
     |--------------------------------------------------------------------------
     |
     | Grant Token is a code generated after creating a new client app at Zoho
     | api console [https://accounts.zoho.com/developerconsole].This code
     | must be used to generate refresh_token with 60 seconds after
     | which it expires.
     |
     */
    'code'           => env('ZOHO_CODE'),

    'redirect_uri'    => env('ZOHO_REDIRECT_URI'),
];
