<?php

namespace NotificationChannels\NextSms;

use NextSMS\SDK\NextSMS as NextSmsSDK;
use Exception;
use Illuminate\Notifications\Notification;
use NotificationChannels\NextSms\Exceptions\CouldNotSendNotification;

class NextSmsChannel
{
    /** @var NextSmsSDK */
    protected $nextSms;

    /** @param NextSmsSDK $nextSms */
    public function __construct(NextSmsSDK $nextSms)
    {
        $this->nextSms = $nextSms;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     *
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toNextSms($notifiable);

        if (!$phoneNumber = $notifiable->routeNotificationFor('nextSms')) {
            $phoneNumber = $notifiable->phone_number;
        }

        try {
            $this->nextSms->singleDestination([
                'to'      => $phoneNumber,
                'text' => $message->getContent(),
                'from'    => $message->getSender(),
            ]);
        } catch (Exception $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        }
    }
}
