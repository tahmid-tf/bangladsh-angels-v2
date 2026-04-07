<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AamarPay mode: "sandbox" or "live"
    |--------------------------------------------------------------------------
    */
    'mode' => env('AAMARPAY_MODE', 'sandbox'),

    'currency' => env('AAMARPAY_CURRENCY', 'USD'),

    /*
    | When true, GET /payment/complete?payment_id= (unsigned) still works for a
    | short window if the payment row is recent. Disable in production once all
    | return URLs point at Laravel /payment/aamarpay/callback.
    */
    'allow_legacy_payment_complete' => env('AAMARPAY_LEGACY_COMPLETE', false),

    'sandbox' => [
        'jsonpost_url' => env('AAMARPAY_SANDBOX_JSONPOST_URL', 'https://sandbox.aamarpay.com/jsonpost.php'),
        'trxcheck_base' => env('AAMARPAY_SANDBOX_TRXCHECK_URL', 'https://sandbox.aamarpay.com/api/v1/trxcheck/request.php'),
        // AamarPay panels often label this “store” or “merchant” — both env names work.
        'store_id' => env('AAMARPAY_SANDBOX_STORE_ID') ?: env('AAMARPAY_SANDBOX_MERCHANT_ID', 'aamarpaytest'),
        'signature_key' => env('AAMARPAY_SANDBOX_SIGNATURE_KEY'),
    ],

    'live' => [
        'jsonpost_url' => env('AAMARPAY_LIVE_JSONPOST_URL', 'https://secure.aamarpay.com/jsonpost.php'),
        'trxcheck_base' => env('AAMARPAY_LIVE_TRXCHECK_URL', 'https://secure.aamarpay.com/api/v1/trxcheck/request.php'),
        'store_id' => env('AAMARPAY_LIVE_STORE_ID') ?: env('AAMARPAY_LIVE_MERCHANT_ID'),
        'signature_key' => env('AAMARPAY_LIVE_SIGNATURE_KEY'),
    ],

];
