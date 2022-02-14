<?php

namespace Divergent\Bkash\Apis\Checkout;

class Payout extends CheckoutBaseApi
{

    public function b2cPayment($amount, $merchantInvoiceNumber, $receiverMSISDN, $currency = 'BDT')
    {
        return $this->callApi(
            'POST',
            'payment/b2cPayment',
            [
                'amount'                => $amount,
                'currency'              => $currency,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'receiverMSISDN'        => $receiverMSISDN
            ]
        );
    }

    public function initiatPayout($type = 'B2B', $reference = '')
    {
        return $this->callApi(
            'POST',
            'payout/initiate',
            [
                'type' => $type,
                'reference' => $reference
            ]
        );
    }

    public function b2bPayout($payoutID, $amount, $merchantInvoiceNumber, $receiverMSISDN, $currency = 'BDT')
    {
        return $this->callApi(
            'POST',
            'payout/b2b',
            [
                'payoutID'              => $payoutID,
                'amount'                => $amount,
                'currency'              => $currency,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'receiverMSISDN'        => $receiverMSISDN
            ]
        );
    }

    public function queryPayout($payoutID)
    {
        return $this->callApi(
            'GET',
            'payout/query/' . $payoutID,
        );
    }
}
