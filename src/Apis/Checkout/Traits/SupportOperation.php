<?php

namespace Divergent\Bkash\Apis\Checkout\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait SupportOperation
{
    public function searchTransaction($trxID)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::CHECKOUT_PAYMENT_SEARCH . $trxID
        );
    }

    public function queryOrgBalance()
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::CHECKOUT_ORG_BALANCE
        );
    }


    public function intraAccountTransfer($amount, $transferType, $currency = 'BDT')
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_INTRA_TRANSFER,
            [
                'amount'       => $amount,
                'currency'     => $currency,
                'transferType' => $transferType
            ]
        );
    }
}
