<?php

namespace NotificationChannels\NextSms\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function configurationNotSet(): self
    {
        return new static('To send notifications via NextSMS you need to add credentials in the `nextsms` configs.');
    }
}
