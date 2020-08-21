<?php

namespace Pkboom\GoogleSheets;

use Google_Client;
use Google_Service_Sheets;
use Illuminate\Support\Facades\Cache;

class GoogleSheetsFactory
{
    public static function create()
    {
        $client = self::createAuthenticatedGoogleClient();

        $service = new Google_Service_Sheets($client);

        return self::createSheetsClient($service);
    }

    public static function createAuthenticatedGoogleClient(): Google_Client
    {
        $client = new Google_Client();

        $client->setApplicationName(config('app.name'));
        $client->setAccessType(config('google-sheets.access_type'));
        $client->setAccessToken(Cache::get(config('google-sheets.access_token_key')));

        return $client;
    }

    protected static function createSheetsClient(Google_Service_Sheets $service): GoogleSheets
    {
        return new GoogleSheets($service);
    }
}
