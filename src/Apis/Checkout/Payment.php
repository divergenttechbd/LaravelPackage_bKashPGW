<?php

namespace Divergent\Bkash\Apis\Checkout;

class Payment extends CheckoutBaseApi
{

    public function create($amount, $merchantInvoiceNumber, $intent, $currency = 'BDT', $merchantAssociationInfo = null)
    {
        return $this->callApi(
            'POST',
            'payment/create',
            [
                'amount' => $amount,
                'currency' => $currency,
                'intent' => $intent,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'merchantAssociationInfo' => $merchantAssociationInfo
            ],
        );
    }

    public function execute($paymentID)
    {
        return $this->callApi(
            'POST',
            'payment/execute/' . $paymentID
        );
    }

    public function queryPayment($paymentID)
    {
        return $this->callApi(
            'GET',
            'payment/query/' . $paymentID
        );
    }

    
    public function capture($paymentID)
    {
        return $this->callApi(
            'POST',
            'payment/capture/' . $paymentID
        );
    }

    public function void($paymentID)
    {
        return $this->callApi(
            'POST',
            'payment/void/' . $paymentID
        );
    }
}
