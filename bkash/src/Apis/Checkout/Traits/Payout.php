<?php

namespace Divergent\Bkash\Apis\Checkout\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait Payout
{
    public function b2cPayment($amount, $merchantInvoiceNumber, $receiverMSISDN, $currency = 'BDT')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_B2C_PAYOUT,
            [
                'amount'                => $amount,
                'currency'              => $currency,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'receiverMSISDN'        => $receiverMSISDN
            ]
        );
    }

    public function initiatePayout($type = 'B2B', $reference = '')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_PAYOUT_INITIATE,
            [
                'type' => $type,
                'reference' => $reference
            ]
        );
    }

    public function b2bPayout($payoutID, $amount, $merchantInvoiceNumber, $receiverMSISDN, $currency = 'BDT')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_B2B_PAYOUT,
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
            BkashConstant::METHOD_GET,
            EndPoints::CHECKOUT_QUERY_PAYOUT . $payoutID,
        );
    }
}
