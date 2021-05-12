<?php

namespace NotificationChannels\NextSms;

use NextSms\SDK\NextSms as NextSmsSDK;
use Exception;
use Illuminate\Notifications\Notification;
use NotificationChannels\NextSms\Exceptions\CouldNotSendNotification;

class NextSmsChannel
{
    /** @var NextSmsSDK */
    protected $nextsms;

    /** @param NextSmsSDK $nextsms */
    public function __construct(NextSmsSDK $nextsms)
    {
        $this->nextsms = $nextsms;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toNextSms($notifiable);

        if (! $phoneNumber = $notifiable->routeNotificationFor('nextsms')) {
            $phoneNumber = $notifiable->phone_number;
        }

        try {
            $this->nextsms->singleDestination([
                'to' => $phoneNumber,
                'message' => $message->getContent(),
                'from' => $message->getSender(),
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        } catch (Exception $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        }
    }
}
