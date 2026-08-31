<?php

namespace JeffersonGoncalves\Benefit;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\Translatable\Translatable;

class BenefitServiceProvider extends PackageServiceProvider
{
    public static string $name = 'benefit';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_benefits_table',
            ]);
    }

    public function packageBooted(): void
    {
        app(Translatable::class)->fallback(
            fallbackLocale: config('app.fallback_locale', 'en'),
            fallbackAny: true,
        );
    }
}
