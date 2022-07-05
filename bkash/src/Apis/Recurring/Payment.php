<?php

namespace Divergent\Bkash\Apis\Recurring;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

class Payment extends RecurringApi {

    public function __construct()
    {
        parent::__construct(config(BkashConstant::RECURRING));
    }

    public function paymentListBySubscriptionID($subscriptionId)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::RECURRING_PAYMENT_LIST . $subscriptionId
        );
    }
    
    public function paymentInfoByPaymentID($paymentId)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::RECURRING_PAYMENT_INFO . $paymentId
        );
    }

    public function refund($paymentId, $amount)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::RECURRING_PAYMENT_REFUND,
            [
                'paymentId' => $paymentId,
                'amount' => $amount
            ]
        );
    }
    
    public function schedule($frequency, $startDate, $expiryDate)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::RECURRING_PAYMENT_SCHEDULE,
            [
                'frequency' => $frequency,
                'startDate' => $startDate,
                'expiryDate' => $expiryDate
            ]
        );
    }

}