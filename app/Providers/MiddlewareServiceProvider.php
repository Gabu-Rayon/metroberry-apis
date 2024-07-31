<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\SetLocale;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->router->pushMiddlewareToGroup('web', SetLocale::class);
    }

    public function register()
    {
        //
    }
}
