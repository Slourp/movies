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
    'moviedb' => [
        'url' => env('THE_MOVIE_DB_URL', 'https://api.themoviedb.org/3'),
        'token' => env('THE_MOVIE_DB_TOKEN', null),
    ],
];
