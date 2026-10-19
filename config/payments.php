<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Stripe Configuration
    |--------------------------------------------------------------------------
    */
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | PayPal Configuration
    |--------------------------------------------------------------------------
    */
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
        'mode' => env('PAYPAL_MODE', 'sandbox'), // sandbox or live
    ],

    /*
    |--------------------------------------------------------------------------
    | Fawry Configuration (Egypt)
    |--------------------------------------------------------------------------
    */
    'fawry' => [
        'merchant_code' => env('FAWRY_MERCHANT_CODE'),
        'merchant_key' => env('FAWRY_MERCHANT_KEY'),
    ],
];
