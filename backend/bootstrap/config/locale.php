<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'default' => env('APP_LOCALE', 'id'),

    'fallback' => env('APP_FALLBACK_LOCALE', 'en'),

    'supported' => ['id', 'en'],

    /*
    |--------------------------------------------------------------------------
    | Locale Display Names
    |--------------------------------------------------------------------------
    | 
    | Display names for each supported locale
    |
    */
    'names' => [
        'id' => 'Bahasa Indonesia',
        'en' => 'English',
    ],
];
