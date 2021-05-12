<?php

namespace NotificationChannels\NextSms;

use NextSms\SDK\NextSms as NextSmsSDK;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\NextSms\Exceptions\InvalidConfiguration;

class NextSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /**
         * Bootstrap the application services.
         */
        $this->app->when(NextSmsChannel::class)
            ->needs(NextSmsSDK::class)
            ->give(function () {
                $userName = config('services.nextsms.username');
                $key = config('services.nextsms.key');
                if (is_null($userName) || is_null($key)) {
                    throw InvalidConfiguration::configurationNotSet();
                }
                return new NextSmsSDK(
                    $userName,
                    $key
                );
            });
    }
}
