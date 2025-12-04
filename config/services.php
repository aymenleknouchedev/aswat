<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // OpenWeather configuration
    'openweather' => [
        'key' => env('WEATHER_API_KEY'),
        // Default city; can be overridden or localized later
        'city' => env('WEATHER_CITY', 'Algiers,DZ'),
        // Cache TTL seconds
        'ttl' => env('WEATHER_TTL', 600),
        // Units: metric | imperial
        'units' => env('WEATHER_UNITS', 'metric'),
        // Language (ar for Arabic)
        'lang' => env('WEATHER_LANG', 'ar'),
        // Fallback coordinates for keyless provider (Open-Meteo)
        'lat' => env('WEATHER_LAT', 36.7538),
        'lon' => env('WEATHER_LON', 3.0588),
        // Timezone for daily min/max calculation window
        'tz'  => env('WEATHER_TZ', 'Africa/Algiers'),
    ],

];
