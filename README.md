# Drunk on 419

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devtical/laravel-drunk-on-419.svg?style=flat-square)](https://packagist.org/packages/devtical/laravel-drunk-on-419)
[![Tests](https://img.shields.io/github/actions/workflow/status/devtical/laravel-drunk-on-419/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/devtical/laravel-drunk-on-419/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/devtical/laravel-drunk-on-419.svg?style=flat-square)](https://packagist.org/packages/devtical/laravel-drunk-on-419)

![Cover](art/cover.png)

Handles 419 errors gracefully by redirecting users when CSRF tokens expire.

## Installation

You can install the package via composer:

```bash
composer require devtical/laravel-drunk-on-419
```

## Usage

#### Automatic Middleware Registration

Once installed, the package automatically registers the middleware in the web group to handle CSRF token expiry errors. This means it will handle all requests in the `web` middleware group without requiring manual registration.

#### Flashing Session Data

When a CSRF token expires and a 419 error occurs, the middleware redirects the user to the previous page (if available) or a fallback URL, with an error message flashed to the session. You can display the error message in your views using the following:

```php
@session('expired')
    {{ $value }}
@endsession
```

#### Publishing Language Files

You can publish the language files to customize the error message:

```bash
php artisan vendor:publish --tag=drunkon419-translations
```

This will create a language file in your application at `lang/vendor/drunkon419/session.php`. You can modify the `expired` key to suit your needs:

```php
return [
    'expired' => 'Your session has expired. Please try again.',
];
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
