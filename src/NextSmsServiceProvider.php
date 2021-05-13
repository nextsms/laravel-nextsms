<?php

namespace NotificationChannels\NextSms;

use NextSMS\SDK\NextSMS as NextSmsSDK;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\NextSms\Exceptions\InvalidConfiguration;

class NextSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/nextsms.php' => config_path('nextsms.php'),
            ], 'config');
        }

        /*
         * Bootstrap the application services.
         */
        $this->app->when(NextSmsChannel::class)
            ->needs(NextSmsSDK::class)
            ->give(function () {
                $username = config('nextsms.username');
                $password = config('nextsms.password');

                if (is_null($username) || is_null($password)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return new NextSmsSDK(['username' => $username, 'password' => $password]);
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/nextsms.php', 'nextsms');
    }
}
