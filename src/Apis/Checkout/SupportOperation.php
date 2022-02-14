<?php

namespace Divergent\Bkash\Apis\Checkout;

class SupportOperation extends CheckoutBaseApi
{

    public function searchTransaction($trxID)
    {
        return $this->callApi(
            'GET',
            'payment/search/' . $trxID
        );
    }

    public function queryOrgBalance()
    {
        return $this->callApi(
            'GET',
            'payment/organizationBalance'
        );
    }


    public function intraAccountTransfer($amount, $transferType, $currency = 'BDT')
    {
        return $this->callApi(
            'POST',
            'payment/intraAccountTransfer',
            [
                'amount'       => $amount,
                'currency'     => $currency,
                'transferType' => $transferType
            ]
        );
    }
}
