<?php

namespace NotificationChannels\NextSms\Test;

use Illuminate\Notifications\Notification;
use Mockery;
use NextSMS\SDK\NextSMS as NextSmsSDK;
use NotificationChannels\NextSms\Exceptions\CouldNotSendNotification;
use NotificationChannels\NextSms\NextSmsChannel;
use NotificationChannels\NextSms\NextSmsMessage;

class NextSmsChannelTest extends TestCase
{
    /** @var Mockery\Mock */
    protected $nextSms;

    /** @var \NotificationChannels\NextSms\NextSmsChannel */
    protected $channel;

    public function setUp(): void
    {
        parent::setUp();
        $this->nextSms = Mockery::mock(NextSmsSDK::class);
        $this->channel = new NextSmsChannel($this->nextSms);
    }

    /** @test */
    public function itCanBeInstantiated()
    {
        $this->assertInstanceOf(NextSmsSDK::class, $this->nextSms);
        $this->assertInstanceOf(NextSmsChannel::class, $this->channel);
    }

    /** @test */
    public function itCanSendSmsNotification()
    {
        $this->nextSms->shouldReceive('singleDestination')->once()->andReturn(200);

        $this->channel->send(new TestNotifiable, new TestNotification);
    }
}

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return string
     */
    public function routeNotificationForNextSms()
    {
        return '2551111111111';
    }
}

class TestNotification extends Notification
{
    /**
     * @param $notifiable
     * @return NextSmsMessage
     * @throws CouldNotSendNotification
     */
    public function toNextSms($notifiable)
    {
        return new NextSmsMessage();
    }
}
