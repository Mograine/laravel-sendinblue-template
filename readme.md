# Laravel Sendinblue

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![License][ico-license]][link-license]

The package simply provides a Laravel service provider, facade and config file for the SendinBlue's API v3 official PHP library. <https://github.com/sendinblue/APIv3-php-library>

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
SENDINBLUE_APIKEY=xkeysib-XXXXXXXXXXXXXXXXXXX
```

## Usage

To test it, you can add the folowing code in routes.php.

```php
// routes.php
...
use Mograine\Sendinblue\Facades\Sendinblue;

Route::get('/test', function () {

    // Configure API keys authorization according to the config file
    $config = Sendinblue::getConfiguration();

    // Uncomment below to setup prefix (e.g. Bearer) for API keys, if needed
    // $config->setApiKeyPrefix('api-key', 'Bearer');
    // $config->setApiKeyPrefix('partner-key', 'Bearer');

    $apiInstance = new \SendinBlue\Client\Api\ListsApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
        new GuzzleHttp\Client(),
        $config
    );

    try {
        $result = $apiInstance->getLists();
        dd($result);
    } catch (Exception $e) {
        echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
    }

});
```

To get a idea of the of the API endpoints, visit the API [readme file](https://github.com/sendinblue/APIv3-php-library#documentation-for-api-endpoints).

Be sure to visit the SendinBlue official [documentation website](https://sendinblue.readme.io/docs) for additional information about our API.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

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
