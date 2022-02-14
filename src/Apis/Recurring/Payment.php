<?php

namespace Divergent\Bkash\Apis\Recurring;

class Payment extends RecurringBaseApi {

    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function paymentListBySubscriptionID($subscriptionId)
    {
        return $this->callApi(
            'GET',
            'subscription/payment/bySubscriptionId/' . $subscriptionId
        );
    }
    
    public function paymentInfoByPaymentID($paymentId)
    {
        return $this->callApi(
            'GET',
            'subscription/payment/' . $paymentId
        );
    }

    public function refund($paymentId, $amount)
    {
        return $this->callApi(
            'POST',
            'subscription/payment/refund',
            [
                'paymentId' => $paymentId,
                'amount' => $amount
            ]
        );
    }
    
    public function schedule($frequency, $startDate, $expiryDate)
    {
        return $this->callApi(
            "GET",
            'subscription/payment/schedule',
            [
                'frequency' => $frequency,
                'startDate' => $startDate,
                'expiryDate' => $expiryDate
            ]
        );
    }

}