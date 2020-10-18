<?php

namespace NotSupported\Laravel;

use hisorange\BrowserDetect\Parser;
use Illuminate\Support\ServiceProvider;

class NotSupportedLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/not-supported.php' => config_path('not-supported.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/not-supported.php', 'not-supported');
    }
}
