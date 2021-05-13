<?php

namespace NotificationChannels\NextSms\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    /**
     * @return CouldNotSendNotification
     */
    public static function serviceRespondedWithAnError(string $error): self
    {
        return new static("NextSms service responded with an error: {$error}");
    }
}
