<?php

namespace Pkboom\GoogleSheets;

use Illuminate\Support\ServiceProvider;

class GoogleSheetsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/google-sheets.php', 'google-sheets');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/google-sheets.php' => config_path('google-sheets.php'),
        ]);
    }
}
