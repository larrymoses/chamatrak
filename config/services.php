<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'paypal' => [

        'client_id' => 'AUL8QoGTpbqVtt88gg1qKDx0d0qr5iqJBzRkYLGvJU3zXNa4Ar0ICRtoXriHyBP84MPk4QK8uzfsSYFY',

        'secret' => 'EH9eVI0i3RY4hY2S_8JjQLQuDDH1zPuJ6MXN_EDEdhm39_iKMECbXJu9ECFZwQB4UEhUR1F3E0UgEXQd'

    ],

];
