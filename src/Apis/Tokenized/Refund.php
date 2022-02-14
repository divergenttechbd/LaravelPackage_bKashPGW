<?php

namespace Divergent\Bkash\Apis\Tokenized;

class Refund extends TokenizedBaseApi
{

    public function refundTransaction($paymentID, $amount, $trxID, $sku, $reason)
    {
        return $this->callApi(
            'POST',
            'payment/refund',
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
            'POST',
            'payment/refund',
            [
                'paymentID' => $paymentID,
                'trxID'     => $trxID
            ]
        );
    }
}
