# NextSMS notification channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nextsms/laravel.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/nextsms)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![PHPUnit tests](https://github.com/nextsms/laravel-nextsms/actions/workflows/tests.yml/badge.svg)](https://github.com/nextsms/laravel-nextsms/actions/workflows/tests.yml)

This package makes it easy to send notifications using [NextSMS](https://nextsms.co.tz/) with Laravel.

## Contents

- [About](#about)
- [Installation](#installation)
- [Setting up the NextSMS service](#setting-up-the-nextsms-service)
- [Usage](#usage)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## About

The NextSMS channel makes it possible to send out Laravel notifications as a `SMS` using NextSMS API.

## Installation

You can install this package via composer:

```bash
composer require nextsms/laravel
```

The service provider gets loaded automatically.

### Setting up the NextSMS service

You will need to [Register](https://nextsms.co.tz/register/).

> Remember to add your Sender ID that you will be using to send the messages.

```bash
AFRICASTALKING_USERNAME=""
AFRICASTALKING_PASSWORD=""
AFRICASTALKING_FROM=""
AFRICASTALKING_ENVIROMENT="production"
```

You can publish the package configuration file:

```bash
php artisan vendor:publish --provider="NotificationChannels\NextSMS\NextSmsServiceProvider" --tag="config"
```

Add the `routeNotifcationForNextSMS` method on your notifiable Model. If this is not added,
the `phone_number` field will be automatically used.

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the NextSMS channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNextSms($notification)
    {
        return $this->phone;
    }
}
```

## Usage

To use this package, you need to create a notification class, like `NewsWasPublished` from the example below, in your Laravel application. Make sure to check out [Laravel's documentation](https://laravel.com/docs/master/notifications) for this process.

```php
<?php

use NotificationChannels\NextSMS\NextSmsChannel;
use NotificationChannels\NextSMS\NextSmsMessage;

class NewsWasPublished extends Notification
{

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [NextSmdChannel::class];
    }

    public function toNextSMS($notifiable)
    {
        return (new NextSmsMessage())
                    ->content('Your SMS message content');

    }
}
```

## Testing

```bash
composer test
```

## Security

If you discover any security-related issues, please email alphaolomi at gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Osaigbovo Emmanuel](https://github.com/alphaolomi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## How do I say Thank you?

Leave a ⭐ star and follow me on [Twitter](https://twitter.com/alphaolomi) .
