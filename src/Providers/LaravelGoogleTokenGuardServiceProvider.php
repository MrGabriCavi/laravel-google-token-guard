<?php

namespace MrGabriCavi\LaravelGoogleTokenGuard\Providers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class LaravelGoogleTokenGuardServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        Auth::extend('google-token', function ($app, $name, array $config){

        });
    }
}
