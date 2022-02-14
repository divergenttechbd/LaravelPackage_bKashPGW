<?php

namespace Divergent\Bkash\Apis\Tokenized;

class Payout extends TokenizedBaseApi
{

    public function initiatPayout($type = 'B2B', $reference = '')
    {
        return $this->callApi(
            'POST',
            'payout/initiate',
            [
                'type' => $type,
                'reference' => $reference
            ],
            true
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
            ],
            true
        );
    }

    public function queryPayout($payoutID)
    {
        return $this->callApi(
            'GET',
            'payout/query/' . $payoutID,
            [],
            true
        );
    }
}
