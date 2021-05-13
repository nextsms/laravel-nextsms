<?php

namespace NotificationChannels\NextSms\Test;

use NotificationChannels\NextSms\NextSmsMessage;

class NextSmsMessageTest extends TestCase
{
    /** @var NextSmsMessage */
    protected $message;

    public function setUp(): void
    {
        parent::setUp();
        $this->message = new NextSmsMessage();
        config(['nextsms.from' => 'NEXTSMS']);
    }

    /** @test */
    public function itCanGetTheContent()
    {
        $this->message->content('myMessage');
        $this->assertEquals('myMessage', $this->message->getContent());
    }

    /** @test */
    public function itCanGetTheSender()
    {
        $this->message->from('YOURSHORTCODE');
        $this->assertEquals('YOURSHORTCODE', $this->message->getSender());
    }

    /** @test */
    public function itCanGetTheDefaultSender()
    {
        $this->assertEquals('NEXTSMS', $this->message->getSender());
    }
}
