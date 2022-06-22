# Laravel Sendinblue Notification Template

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![License][ico-license]][link-license]

The package simply provides a Laravel service provider, facade and config file for the SendinBlue's API v3 official PHP library. <https://github.com/sendinblue/APIv3-php-library>

It also allow to simply send a laravel notification using a SendInBlue transactional template.

## Installation

You can install this package via Composer using:

```bash
composer require mograine/laravel-sendinblue-template-template
```

## Configuration

You need to publish the config file to `app/config/sendinblue.php`. To do so, run:

```bash
php artisan vendor:publish --tag=sendinblue.config
```

Now you need to set your configuration using **environment variables**.
Go the the Sendinblue API settings and add the v3 API key to your `.env` file.

```bash
SENDINBLUE_API_KEY=xkeysib-XXXXXXXXXXXXXXXXXXX
SENDINBLUE_EMAIL=defaultEmail
SENDINBLUE_NAME=defaultName
```

## Usage

This package provide a built-in notification channel to send transactional template emails.

To test it, create a new notification using the ``php artisan make:notification`` command.

Example of usage :

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Mograine\Sendinblue\SendInBlueMailTemplateChannel;
use Mograine\Sendinblue\TemplateMessage;

class NewOfferNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [ SendInBlueMailTemplateChannel::class ];
    }

    public function toMailTemplate($notifiable): TemplateMessage
    {
        $templateId = 1;
        $templateMessage = new TemplateMessage($templateId);
        $templateMessage->attribute('USER_EMAIL', $notifiable->email);
        return $templateMessage;
    }
}
```

You can also get any V3 SendInBlue API using the built-in getAPI method :

```php
use Mograine\Sendinblue\SendinblueApiEnum;
use Mograine\Sendinblue\Facades\Sendinblue;

// We first get the API we want
$transactionalApi = Sendinblue::getApi(SendinblueApiEnum::TransactionalEmailsApi);

// We can then easily use it, example :
$transactionalApi->deleteBlockedDomain('exampleSendinblueDomain.com');
```

Be sure to visit the SendinBlue official [documentation website](https://sendinblue.readme.io/docs) for additional information about the API.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://poser.pugx.org/mograine/laravel-sendinblue-template/v/stable
[ico-downloads]: https://poser.pugx.org/mograine/laravel-sendinblue-template/downloads
[ico-license]: https://poser.pugx.org/mograine/laravel-sendinblue-template/license
[link-packagist]: https://packagist.org/packages/mograine/laravel-sendinblue-template
[link-downloads]: https://packagist.org/packages/mograine/laravel-sendinblue-template
[link-license]: https://github.com/mograine/laravel-sendinblue-template/blob/HEAD/license.md
