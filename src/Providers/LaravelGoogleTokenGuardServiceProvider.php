<?php

namespace MrGabriCavi\LaravelGoogleTokenGuard\Providers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use MrGabriCavi\LaravelGoogleTokenGuard\Security\Guard\LaravelGoogleTokenGuard;


class LaravelGoogleTokenGuardServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        Auth::extend('google-token', function ($app, $name, array $config) {
            return new LaravelGoogleTokenGuard(
                Auth::createUserProvider($config['provider']), $name, $app->make('request'));
        });
    }
}
