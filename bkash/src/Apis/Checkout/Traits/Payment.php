<?php

namespace Divergent\Bkash\Apis\Checkout\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait Payment
{
    public function create($amount, $merchantInvoiceNumber, $intent, $currency = 'BDT', $merchantAssociationInfo = null)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_CREATE_PAYMENT,
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
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_EXECUTE_PAYMENT . $paymentID
        );
    }

    public function queryPayment($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::CHECKOUT_QUERY_PAYMENT . $paymentID
        );
    }


    public function capture($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_CAPTURE_PAYMENT . $paymentID
        );
    }

    public function void($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::CHECKOUT_VOID_PAYMENT . $paymentID
        );
    }
}
