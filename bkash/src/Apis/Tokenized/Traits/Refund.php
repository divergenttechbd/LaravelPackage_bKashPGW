<?php

namespace Divergent\Bkash\Apis\Tokenized\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait Refund
{
    public function refundTransaction($paymentID, $amount, $trxID, $sku, $reason)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_PAYMENT_REFUND,
            [
                'paymentID' => $paymentID,
                'amount' => $amount,
                'trxID' => $trxID,
                'sku' => $sku,
                'reason' => $reason
            ],
        );
    }

    public function refundStatus($paymentID, $trxID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_REFUND_STATUS,
            [
                'paymentID' => $paymentID,
                'trxID'     => $trxID
            ]
        );
    }
}
