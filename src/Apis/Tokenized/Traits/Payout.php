<?php

namespace Divergent\Bkash\Apis\Tokenized\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait Payout
{
    public function initiatePayout($type, $reference = '')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_PAYOUT_INITIAT,
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
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_B2B_PAYOUT,
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

    public function b2cPayout($payoutID, $amount, $merchantInvoiceNumber, $receiverMSISDN, $currency = 'BDT')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_B2C_PAYOUT,
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

    public function intraAccountTransfer($payoutID, $amount, $transferType, $currency = 'BDT')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_INTRA_TRANSFER,
            [
                'payoutID'     => $payoutID,
                'amount'       => $amount,
                'currency'     => $currency,
                'transferType' => $transferType
            ],
            true
        );
    }

    public function queryPayout($payoutID)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::TOKENIZED_QUERY_PAYOUT . $payoutID,
            [],
            true
        );
    }
}
