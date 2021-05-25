<?php

namespace NotificationChannels\NextSms\Test;

use Mockery;
use NotificationChannels\NextSms\NextSmsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            NextSmsServiceProvider::class,
        ];
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();

        if ($container = \Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        Mockery::close();
    }
}
