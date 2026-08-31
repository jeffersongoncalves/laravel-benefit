<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Names
    |--------------------------------------------------------------------------
    |
    | Table name used by the package. Override this if it collides with an
    | existing table in your application.
    |
    */
    'table_names' => [
        'benefits' => 'benefits',
    ],

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | Locales supported by the translatable fields (name, description).
    | Mirrors spatie/laravel-translatable's own convention: reads from
    | `app.available_locales` (an array keyed by locale code, e.g.
    | ['en' => 'English', 'pt_BR' => 'Português']) when present, otherwise
    | falls back to the application's default locale.
    |
    */
    'locales' => config('app.available_locales')
        ? array_keys(config('app.available_locales'))
        : [config('app.locale', 'en')],
];
