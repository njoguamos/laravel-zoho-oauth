# Welcome

![run-tests](https://github.com/njoguamos/laravel-zoho-oauth/workflows/run-tests/badge.svg)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/njoguamos/laravel-zoho-oauth.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-zoho-oauth)
[![Total Downloads](https://img.shields.io/packagist/dt/njoguamos/laravel-zoho-oauth.svg?style=flat-square)](https://packagist.org/packages/njoguamos/laravel-zoho-oauth)

Welcome to Laravel Zoho OAuth Documentation. Use this package to generate Zoho API access and refresh token in Laravel 8.* and up applications.

## Prerequisites
To use this package, 
1. Ensure you have a [Zoho](https://zoho.com/) account, if not [create one now](https://accounts.zoho.com/register)
2. Have some basics on Zoho APIs. Here are the most popular Zoho apps

    | Zoho App          | API Documentation                                          |
    | ----------------- | ---------------------------------------------------------- |
    | Zoho Inventory    | [API Documentation](https://www.zoho.com/inventory/)       |
    | Zoho CRM          | [API Documentation](https://www.zoho.com/crm/developer/docs/api/v2/modules-api.html)       |
    | Zoho Campaigns    | [API Documentation](https://www.zoho.com/campaigns/help/developers/)       |
    | Zoho Books        | [API Documentation](https://www.zoho.com/books/api/v3/)       |
    | Zoho Projects     | [API Documentation](https://www.zoho.com/projects/help/rest-api/get-tickets-api.html/)       |

3. Ensure you have Zoho API Client ID, Zoho Client API Secret and Zoho authorization code. If not, [follow these instruction](/laravel-zoho-oauth/instructions)


## Usage

### 01 Installation

Use the Composer package manager to install this package into your Laravel project:

```bash
composer require njoguamos/laravel-zoho-oauth
```


### 02 Update your `.env` variables

Add the following vairables and update accordingly. [Follow these instruction](/laravel-zoho-oauth/instructions)

```dotenv
# Zoho OAuth Credentials
BASE_OAUTH_URL=
ZOHO_CLIENT_ID=
ZOHO_CLIENT_SECRET=
ZOHO_CODE=
ZOHO_SCOPE=
```

### 03 Prepare database

You need to publish the migration to create the `zoho_outh` table:

```bash
php artisan vendor:publish --provider="Njoguamos\LaravelZohoOauth\ZohoOauthServiceProvider" --tag="migrations"
```


After that, you need to run migrations.

```bash
php artisan migrate
```


### 04 Publishing the config file

You may optinally export config using the following command,

```bash
php artisan vendor:publish --provider="Njoguamos\LaravelZohoOauth\ZohoOauthServiceProvider" --tag="config"
```


### 05 Initilize the package

Run the init command when you have a new `code`. This command add a new record of `refresh_token` and `access_token` to the 'zoho_oauth_table`

```bash
php artisan zoauth:init
```

This command may fail:
1. When you are not connected to the internet
2. When `ZOHO_CLIENT_ID` or `ZOHO_CLIENT_SECRET` or `ZOHO_CODE` is invalid

### 06 Generate Access Token From Refresh Token

To generate `access_token` anytime run the following command.

```bash
php artisan zoauth:refresh
```

This command will add a new `access_token` to the database and set it expiration to one hour.


### 07 Generate Access Token frequently

`access_token` expires after a particular period usually after `one hour`. After expiring, you have to use `refresh_token` to generate a new 
`access_token`. 

Schedule the refresh token command in the console kernel. The schedule time should be less than one hour.

```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    ...
    $schedule->command('zoauth:refresh')->everyThirtyMinutes();
    ...
}
```

## Usage

You may get the latest authorization token as follows

```php
namespace App\Http\Controllers;

use Njoguamos\LaravelZohoOauth\Models\ZohoOauth;
use Illuminate\Support\Facades\Http;

class ZohoController extends Controller {

    public function index(){
    
      $token = ZohoOauth::latest()->first()?->auth_token;
     // "Zoho-oauthtoken 1000.27cb28ac001d4f1b610f06c414fc5d5a.8fa8f34f61e4c2cc9c466e8aaccba395"

      $response = Http::withHeaders(['Authorization' => $token])->get(//zoho url);

     //...
  }

}

```

## Post Installation

### 01 Revoke and Access Token

To revoke a refresh token, load it from database and call `->revoke()`
```php

// Todo: Write revoke method

```

### 02 Delete expired access tokens

Generating `refresh_token` frequently populates the database. As a results it is recommended you schedule the following command

```php

// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    ...
    $schedule->command('zoauth:prune')->daily();
    ...
}

```
