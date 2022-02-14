<?php

return [
    'intent' => env('BKASH_INTENT', 'sale'),
    'checkout' => [
        'sandbox' => env('BKASH_CHECKOUT_SANDBOX', 'true'),
        'version' => env('BKASH_CHECKOUT_VERSION', 'v1.2.0-beta'),
        'app_key' => env('BKASH_CHECKOUT_APP_KEY', ''),
        'app_secret' => env('BKASH_CHECKOUT_APP_SECRET', ''),
        'username' => env('BKASH_CHECKOUT_USER_NAME', ''),
        'password' => env('BKASH_CHECKOUT_PASSWORD', ''),
        'sandbox_script' => env('BKASH_CHECKOUT_SANDBOX_SCRIPT', ''),
        'production_script' => env('BKASH_CHECKOUT_PRODUCTION_SCRIPT', ''),
    ],
    'tokenized' => [
        'sandbox' => env('BKASH_TOKENIZED_SANDBOX', 'true'),
        'version' => env('BKASH_TOKENIZED_VERSION', 'v1.2.0-beta'),
        'app_key' => env('BKASH_TOKENIZED_APP_KEY', ''),
        'app_secret' => env('BKASH_TOKENIZED_APP_SECRET', ''),
        'username' => env('BKASH_TOKENIZED_USER_NAME', ''),
        'password' => env('BKASH_TOKENIZED_PASSWORD', ''),
        'call_back_url' => env('BKASH_TOKENIZED_CALL_BACK_URL', '')
    ],
    'recurring' => [
        'merchant_short_code' => env('BKASH_RECURRING_MERCHANT_SHORT_CODE'),
        'api_key' => env('BKASH_RECURRING_API_KEY', ''),
        'redirect_url' => env('BKASH_RECURRING_REDIRECT_URL', ''),
        'version' => env('BKASH_RECURRING_VERSION', ''),
        'channelId' => env('BKASH_CHANNEL_ID_VERSION', ''),
        'amountQueryUrl' => env('BKASH_AMOUNT_QUERY_URL', null),
        'serviceId' => env('BKASH_RECURRING_SERVICE_ID', ''),
        'maxCapAmount' => env('BKASH_RECURRING_MAX_CAP_AMOUNT', null),
        'maxCapRequired' => env('BKASH_RECURRING_MAX_CAP_REQUIRED', false),
        'payer' => env('BKASH_RECURRING_PAYER', null),
        'payerType' => env('BKASH_RECURRING_PAYER_TYPE', 'CUSTOMER'),
        'paymentType' => env('BKASH_RECURRING_PAYMENT_TYPE', 'FIXED'),
    ]
];
