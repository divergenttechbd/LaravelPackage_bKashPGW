**Laravel Package for bKash Payment Gateway**
=

# Installation & Configuration

### Go to project directory and open terminal. Then run this command

```
composer require divergent/bkash
```

### For Laravel version below 5.5 open config/app file and add this line in `providers` array

If you are using Laravel version greater than 5.5 then skip this section

```
Divergent\Bkash\BkashServiceProvider::class,
```

### After that run this command in command line/Terminal

```
php artisan vendor:publish --provider="Divergent\Bkash\BkashServiceProvider"
```

After successfully publishing, update your .env file. Here is an [Example](https://github.com/rootmap/BkashPaymentAPI/wiki/.env/) ENV file.

You will also see **bkash.php** located in **config** folder. Below contents will found in **bkash.php** file after successfully published.

```
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
```

### Finally, just run this command

```
php artisan migrate
```

This command will generate some necessary database tables which allow merchant to use this package more efficiently. 

NOTE: You can **add/remove** any fields (if you need) of these tables.

# Usage

## Checkout

- [Payment](#checkout-payment)
- [Payout](#checkout-payout)
- [Supporting Operations](#checkout-supporting-operations)
- [Refund](#checkout-refund)

## Tokenized

- [Agreement](#tokenized-agreement)
- [Payment](#tokenized-payment)
- [Payout](#tokenized-payout)
- [Refund](#tokenized-refund)

## Recurring

- [Subscription](#recurring-subscription)
- [Payment](#recurring-payment)

## Webhook

- [General Webhook](#general-webhook)
- [Recurring Webhook](#recurring-webhook)

## Checkout Payment

For calling **Checkout Payment** methods, first you need to create instance of **CheckoutApi** class.

Don't forget to import `use Divergent\Bkash\Apis\Checkout\CheckoutApi;` top of the file.

NOTE: Configurations will be fetch from your previously setup in **.env** file. Remember that you need to set token for authorization.

```
$checkout = new CheckoutApi();

//you can get token by calling getToken() method.
$token = $checkout->getToken();

//you can set token by calling setToken() method.
$checkout->setToken($token['token']);
```

### Create Payment (Sale or Capture)

```
$amount = 'your product amount';
$invoice_no = 'any unique number used in marchant side';
$intent = env('BKASH_INTENT'); //intent will be 'sale' or 'authorization' which you have defined in .env file.

$checkout->create($amount, $invoice_no, $intent);

```

`$merchantAssociationInfo` is optional field. Default `$currency` is **BDT**.

### Execute Payment

```
$checkout->execute($paymentID);
```

You will get `$paymentID` from [Create Payment](#create-payment-sale-or-capture)

### Query Payment

```
$checkout->queryPayment($paymentID);
```

You will get `$paymentID` from [Execute Payment](#execute-payment)

### Capture Payment

```
$checkout->capture($paymentID);
```

You will get `$paymentID` from [Execute Payment](#execute-payment)

NOTE: **Capture Payment** will be used for payment with `authorization` intent.

### Void Payment

```
$checkout->void($paymentID);
```

You will get `$paymentID` from [Execute Payment](#execute-payment)

NOTE: **Void Payment** will be used for payment with `authorization` intent.

## Checkout Payout

### Checkout B2C Payout

```
$amount = 'payout amount';
$merchantInvoiceNumber = 'any unique number used in marchant side';
$receiverMSISDN = 'receiver wallet number';

$checkout->b2cPayment($amount, $merchantInvoiceNumber, $receiverMSISDN);
```

### Checkout B2B Payout

```
$amount = 'payout amount';
$merchantInvoiceNumber = 'any unique number used in marchant side';
$receiverMSISDN = 'receiver wallet number';

$initPayout = $checkout->initiatPayout();
$payoutID = $initPayout['payoutID'];
$checkout->b2bPayout($payoutID, $amount, $merchantInvoiceNumber, $receiverMSISDN);
```

First you have to call **initiatPayout** method which return you a **payoutID**. Then you can call **b2bPayout** to make B2B Payout.

### Checkout B2B Query Payout

```
$checkout->queryPayout($payoutID);
```

You will get `$payoutID` from [Checkout B2B Payout](#checkout-b2b-payout).

## Checkout Supporting Operations

### Search Transaction

```
$checkout->searchTransaction($trxID);
```

You will get `$trxID` from [Execute Payment](#execute-payment)

### Query Organization Balance

```
$checkout->queryOrgBalance();
```

### Intra-Account Transfer

```
$amount = 'amount to transfer';
$transferType = 'transfer type'; //It can be either 'Collection2Disbursement' or 'Disbursement2Collection'.

$checkout->intraAccountTransfer($amount, $transferType);
```

## Checkout Refund

### Refund Transaction

```
$paymentID = 'payment ID';
$amount = 'refund amount';
$trxID = 'transaction ID';
$sku = 'product unique code';
$reason = 'reason for refund';

$checkout->refundTransaction($paymentID, $amount, $trxID, $sku, $reason);
```

`$sku` and `$reason` are optional fields. You will get `$paymentID` and `$trxID` from [Execute Payment](#execute-payment).

### Refund Status

```
$checkout->refundStatus($paymentID, $trxID);
```

You will get `$paymentID` and `$trxID` from [Execute Payment](#execute-payment).

## Tokenized Agreement

For calling **Tokenized Agreement** methods, first you need to create instance of **TokenizedApi** class.

Don't forget to import `use Divergent\Bkash\Apis\Tokenized\TokenizedApi;` top of the file.

NOTE: Configurations will be fetch from your previously setup in **.env** file. Remember that you need to set token for authorization.

```
$tokenized = new TokenizedApi();

//you can get token by calling getToken() method.
$token = $tokenized->getToken();

//you can set token by calling setToken() method.
$tokenized->setToken($token['token']);

```

### Create Agreement

```
$payerReference = 'any related reference value';

$tokenized->createAgreement(BkashConstant::CREATE_AGREEMENT, $payerReference);

```

To create agreement, first `BkashConstant::CREATE_AGREEMENT` parameter need to pass which allow callback url to know which page to redirect. The possible constant list with defination is given below for better understanding - 

### Bkash Constant Defination

* `BkashConstant::CREATE_AGREEMENT` - Used for create agreement.
* `BkashConstant::WITHOUT_AGREEMENT_PAYMENT` - used for make payment without agreement.
* `BkashConstant::WITH_AGREEMENT_PAYMENT` - Used for make payment with agreement.
* `BkashConstant::PAYMENT` - Used for create payment only.

NOTE: **Merchant side must need to main database table to get to know if user is already created agreement or not.**

### Execute Agreement

```
$tokenized->executeAgreement($paymentID);
```
You will get `$paymentID` from [Create Agreement](#create-agreement).

### Agreement Status

```
$tokenized->status($agreementID);
```

You will get `$agreementID` from [Create Agreement](#create-agreement).

### Agreement Cancel

```
$tokenized->cancel($agreementID);
```

You will get `$agreementID` from [Create Agreement](#create-agreement).

## Tokenized Payment

### Tokenized Create Payment (Sale or Capture)

```
$intent = 'sale or authorization'; //better to get data from ENV.
$payerReference = 'any related reference value';
$amount = 'your product amount';
$invoice_no = 'any unique number used in marchant side';

//create payment with agreement
$tokenized->createAgreement(BkashConstant::WITH_AGREEMENT_PAYMENT, $payerReference, $amount, $invoice_no, '');

//create payment without agreement
$tokenized->create($intent, BkashConstant::WITHOUT_AGREEMENT_PAYMENT, $payerReference, $amount, $invoice_no, '');

```

To create payment, first `BkashConstant::PAYMENT` parameter need to pass which allow callback url to know which page to redirect. This constant also define which action you are going to call. You can find more about it [Here](#bkash-constant-defination). You will get `$agreementID` from [Create Agreement](#create-agreement). `$merchantAssociationInfo` is optional field. Default `$currency` is **BDT**.

### Tokenized Execute Payment

```
$tokenized->execute($paymentID);
```

You will get `$paymentID` from [Create Payment](#tokenized-create-payment-sale-or-capture).

### Tokenized Query Payment

```
$tokenized->queryPayment($paymentID);
```

You will get `$paymentID` from [Execute Payment](#tokenized-execute-payment).

### Tokenized Capture Payment

```
$tokenized->capture($paymentID);
```

You will get `$paymentID` from [Execute Payment](#tokenized-execute-payment)

NOTE: **Tokenized Capture Payment** will be used for payment with `authorization` intent.

### Tokenized Void Payment

```
$tokenized->void($paymentID);
```

You will get `$paymentID` from [Execute Payment](#tokenized-execute-payment)

NOTE: **Tokenized Void Payment** will be used for payment with `authorization` intent.

## Tokenized Payout

### Tokenized Intra-Account Transfer

```
$amount = 'amount to transfer';
$transferType = 'transfer type'; //It can be either 'Collection2Disbursement' or 'Disbursement2Collection'.

$initPayout = $tokenized->initiatePayout("INTRA");
$payoutID = $initPayout['payoutID'];
$tokenized->intraAccountTransfer($amount, $transferType);
```

### Tokenized B2C Payout

```
$amount = 'payout amount';
$merchantInvoiceNumber = 'any unique number used in marchant side';
$receiverMSISDN = 'receiver wallet number';

$initPayout = $tokenized->initiatPayout("B2C");
$payoutID = $initPayout['payoutID'];
$tokenized->b2cPayout($payoutID, $amount, $merchantInvoiceNumber, $receiverMSISDN);
```

### Tokenized B2B Payout

```
$amount = 'payout amount';
$merchantInvoiceNumber = 'any unique number used in marchant side';
$receiverMSISDN = 'receiver wallet number';

$initPayout = $tokenized->initiatPayout("B2B");
$payoutID = $initPayout['payoutID'];
$tokenized->b2bPayout($payoutID, $amount, $merchantInvoiceNumber, $receiverMSISDN);
```

First you have to call **initiatPayout** method which return you a **payoutID**. Then you can call **b2bPayout** to make B2B Payout.

### Tokenized B2B Query Payout

```
$tokenized->queryPayout($payoutID);
```

You will get `$payoutID` from [Tokenized B2B Payout](#tokenized-b2b-payout).

## Tokenized Refund

### Refund Transaction

```
$paymentID = 'payment ID';
$amount = 'refund amount';
$trxID = 'transaction ID';
$sku = 'product unique code';
$reason = 'reason for refund';

$tokenized->refundTransaction($paymentID, $amount, $trxID, $sku, $reason);
```

`$sku` and `$reason` are optional fields. You will get `$paymentID` and `$trxID` from [Execute Payment](#tokenized-execute-payment).

### Refund Status

```
$tokenized->refundStatus($paymentID, $trxID);
```

You will get `$paymentID` and `$trxID` from [Execute Payment](#tokenized-execute-payment).

## Recurring Subscription

For calling **Recurring Subscription** methods, first you need to create instance of **Subscription** class.

Don't forget to import `use Divergent\Bkash\Apis\Recurring\Subscription;` top of the file.

NOTE: Configurations will be fetch from your previously setup in **.env** file. 

```
$subscription = new Subscription();
```

### Create Subscription

```
$data = [
            "subscriptionRequestId" => "System generated unique id",
            "serviceId" => "Provided by bKash",
            "paymentType" => "FIXED",
            "subscriptionType" => "BASIC - indicates only scheduled payment and WITH_PAYMENT - indicates a  mandatory immediate payment for subscription creation",
            "amountQueryUrl" => null,
            "amount" => "Amount that will be recurrently paid",
            "firstPaymentAmount" => "Amount needs to be paid when subscription is created for the first time",
            "currency" => "BDT",
            "firstPaymentIncludedInCycle" => "If subscription has first payment during registration",
            "maxCapAmount" => "Maximum value of a payment",
            "maxCapRequired" => false,
            "frequency" => "Cycles for each subscriptions",
            "startDate" => "From this date, payment deduction will take place",
            "expiryDate" => "After this date, no payment will take place",
            "payerType" => " Whether it is Customer or any partner organization",
            "payer" => "Wallet ID of a customer",
            "subscriptionReference" => "subscription reference shared by merchant",
            "extraParams" => "Optional parameter if needed (should be key value pair)",
            "redirectUrl" => "fetch from env file",
            "merchantShortCode" => "fetch from env file"
        ];

$subscription->create($data);
```

Available recurring cycles are given below -

* `DAILY`
* `WEEKLY`
* `FIFTEEN_DAYS`
* `THIRTY_DAYS`
* `NINETY_DAYS`
* `ONE_EIGHTY_DAYS`
* `CALENDAR_MONTH`
* `CALENDAR_YEAR`

### Subscription Query by Request ID

```
$subscription->queryBySubscriptionRequestID($requestId);
```

You will get `$requestId` from [Create Subscription](#create-subscription).

### Subscription Query by Subscription ID

```
$subscription->queryBySubscriptionID($subscriptionID);
```

You will get `$subscriptionID` from [Subscription Query by Request ID](#subscription-query-by-request-id).

### Cancel Subscription

```
$subscription->cancelSubscription($subscriptionID, $reason);
```

You will get `$subscriptionID` from [Subscription Query by Request ID](#subscription-query-by-request-id). `$reason` is Optional value that contains string value.

### Subscription List

```
$subscription->subscriptionList($page, $size);
```

`$page` is defines from which page you want to see subscription list and `$size` defines the number of rows you want to show.

## Recurring Payment

For calling **Recurring Payment** methods, first you need to create instance of **Payment** class.

Don't forget to import `use Divergent\Bkash\Apis\Recurring\Payment;` top of the file.

NOTE: Configurations will be fetch from your previously setup in **.env** file. 

```
$payment = new Payment();
```

### Payment List by Subscription ID

```
$payment->paymentListBySubscriptionID($subscriptionID);
```

You will get `$subscriptionID` from [Subscription Query by Request ID](#subscription-query-by-request-id).

### Payment Info by Payment ID

```
$payment->paymentInfoByPaymentID($paymentId);
```

You will get `$paymentId` from [Payment List by Subscription ID](#payment-list-by-subscription-id).

### Payment Schedule

```
$payment->schedule($frequency, $startDate, $expiryDate);
```

`$frequency` defines the cycles for each subscriptions. Available recurring cycles are given below -

* `DAILY`
* `WEEKLY`
* `FIFTEEN_DAYS`
* `THIRTY_DAYS`
* `NINETY_DAYS`
* `ONE_EIGHTY_DAYS`
* `CALENDAR_MONTH`
* `CALENDAR_YEAR`

`$startDate` and `$expiryDate` indicates **from** and **to** date for payment schedule.

### Payment Refund

```
$payment->refund($paymentId, $amount);
```

You will get `$paymentId` from [Payment List by Subscription ID](#payment-list-by-subscription-id). `$amount` is which amount you want to refund.

# Webhook

To integrate webhook in your website, you need to create **two** url (route).

- general webhook url
- recurring webhook url

One is to get notification from [Checkout](#checkout), [Tokenized](#tokenized) actions and another is for [Recurring](#recurring) product. 

For calling **Webhook** methods, first you need to create instance of **Webhook** class.

Don't forget to import `use Divergent\Bkash\Apis\Webhook\Webhook;` top of the file.

```
$webhook = new Webhook();
```

### General Webhook

```
$webhook->processWebhookRequest();
```

### Recurring Webhook

```
$webhook->processRecurringWebhookRequest();
```

## Don't worry if you find complexity in implatation by reading this documentation. [Here](https://pages.github.com/) is a demo project. Feel free to use this code. :heart:

# Support

This version supports Laravel 5.0 or greater.
* In case of any issues, kindly create one on the [Issues](https://github.com/rootmap/BkashPaymentAPI/issues) section.
* Feel free to ask for the support over the email `laravelpgw.support@bkash.com`.