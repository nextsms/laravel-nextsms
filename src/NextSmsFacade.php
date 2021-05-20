<?php

namespace NotificationChannels\NextSms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NextSMS\SDK\NextSMS
 */
class NextSmsFacade extends Facade
{
    /**
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'nextsmsservice';
    }
}
