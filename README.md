<div class="filament-hidden">

![Laravel Benefit](https://raw.githubusercontent.com/jeffersongoncalves/laravel-benefit/main/art/jeffersongoncalves-laravel-benefit.png)

</div>

# Laravel Benefit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-benefit.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-benefit)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-benefit/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/laravel-benefit/actions?query=workflow%3ATests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-benefit/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/laravel-benefit/actions?query=workflow%3A%22Fix+PHP+code+style+issues%22+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-benefit.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-benefit)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/laravel-benefit.svg?style=flat-square)](LICENSE.md)

A simple Laravel package providing a translatable `Benefit` Eloquent model, powered by [spatie/laravel-translatable](https://github.com/spatie/laravel-translatable).

## Features

- **Benefit model** — A generic benefit entity with translatable `name` and `description`, plus a unique `slug`
- **Translatable Content** — `name` and `description` are translatable via `spatie/laravel-translatable`, with automatic fallback to the app's fallback locale
- **Configurable Table Name** — Override the `benefits` table name via config
- **Configurable Locales** — Mirrors `app.available_locales` (or the app locale) to describe supported translation locales

## Requirements

- PHP 8.2+
- Laravel 12.x or 13.x

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/laravel-benefit
```

Publish and run the migrations:

```bash
php artisan vendor:publish --tag="benefit-migrations"
php artisan migrate
```

Publish the config file (optional):

```bash
php artisan vendor:publish --tag="benefit-config"
```

## Configuration

The config file (`config/benefit.php`) covers:

### Table Name

```php
'table_names' => [
    'benefits' => 'benefits',
],
```

### Locales

```php
'locales' => config('app.available_locales')
    ? array_keys(config('app.available_locales'))
    : [config('app.locale', 'en')],
```

Reads from `app.available_locales` (an array keyed by locale code, e.g. `['en' => 'English', 'pt_BR' => 'Português']`) when present, otherwise falls back to the app's default locale. The package also configures `spatie/laravel-translatable`'s fallback behavior on boot, so a missing translation for the current locale falls back to `app.fallback_locale` (or any available locale if that is also missing).

## Usage

```php
use JeffersonGoncalves\Benefit\Models\Benefit;

$benefit = Benefit::create([
    'name' => ['en' => 'Free Shipping', 'pt_BR' => 'Frete Grátis'],
    'description' => ['en' => 'No shipping costs on any order.', 'pt_BR' => 'Sem custo de frete em qualquer pedido.'],
    'slug' => 'free-shipping',
]);

$benefit->name; // resolved for the current app locale, with fallback
$benefit->getTranslation('name', 'pt_BR'); // 'Frete Grátis'
$benefit->setTranslation('description', 'es', 'Sin costos de envío.');
$benefit->save();
```

### Translations

Because the model uses `Spatie\Translatable\HasTranslations`, the full [spatie/laravel-translatable API](https://github.com/spatie/laravel-translatable) is available:

```php
$benefit->getTranslation('name', 'pt_BR');
$benefit->setTranslation('name', 'pt_BR', 'Frete Grátis');
$benefit->getTranslations('name'); // ['en' => '...', 'pt_BR' => '...']
$benefit->translate('name', 'pt_BR');
```

### Route model binding

The model uses `slug` as its route key:

```php
Route::get('/benefits/{benefit}', fn (Benefit $benefit) => $benefit);
// resolves via the `slug` column
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
