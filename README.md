# Manage Google Sheets for Laravel applications

[![Latest Stable Version](https://poser.pugx.org/pkboom/google-sheets/v)](//packagist.org/packages/pkboom/google-sheets)
[![Total Downloads](https://poser.pugx.org/pkboom/google-sheets/downloads)](//packagist.org/packages/pkboom/google-sheets)

This package makes working with Google Sheets a breeze. Once it has been set up you can do these things:

```php
namespace Pkboom\GoogleSheets\GoogleSheetsFactory;

$sheets = GoogleSheetsFactory::create();

$response = $sheets->spreadsheetId('spreadsheet id')
    ->range('sheet-name!A2:E4')
    ->get();
```

## Installation

You can install the package via composer:

```bash
composer require pkboom/google-sheets
```

You must publish the configuration with this command:

```bash
php artisan vendor:publish --provider="Pkboom\GoogleStorage\GoogleSheetsServiceProvider"
```

This will publish a file called google-storage.php in your config-directory with these contents:

```php
return [
    /*
     * Set access type, default: online
     */
    'access_type' => 'online',
    /*
     * Set cache key. When GOOGLE_CLIENT is created, it will retrieve the token from cache using this key.
     */
    'access_token_key' => 'google_sheet_token',
];
```

## How to obtain a token using Socialite

```php
use Google_Service_Sheets;

class GoogleLoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')
            ->scopes(Google_Service_Sheets::SPREADSHEETS)
            ->redirect();
    }

    public function handleProviderCallback()
    {
        Cache::put('google_sheet_token', Socialite::driver('google')->user()->token, 3600);

        return Redirect::to('/');
    }
}
```

## Usage

### Get data from a sheet

```php
$response = $sheets->spreadsheetId(Request::input('spreadsheet'))
    ->range('legislators-current!A2:E4')
    ->get();

if (empty($response)) {
    ...
} else {
    ...
}
```

### Create a sheet

```php
$sheets = GoogleSheetsFactory::create();

$spreadsheet = $sheets->create('title');

return $spreadsheet->spreadsheetId;
```

### Get a client from google sheets

You can set a new token key to the client

```php
$sheets = GoogleSheetsFactory::create();

$sheets->getClient()->setAccessToken('new key');
```
