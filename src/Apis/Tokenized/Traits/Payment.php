<?php

namespace Divergent\Bkash\Apis\Tokenized\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait Payment
{
    public function create(
        $intent,
        $request_type,
        $payerReference,
        $amount,
        $merchantInvoiceNumber,
        $merchantAssociationInfo,
        $currency = 'BDT'
    ) {

        if(empty(env('BKASH_TOKENIZED_CALL_BACK_URL'))) {
            return [
                'statusCode' => "500",
                'statusMessage' => 'Please provide callback url in your env file.'
            ];
        } else {
            $callbackUrl = env('BKASH_TOKENIZED_CALL_BACK_URL') . '?request_type=' . $request_type;
        }

        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_CREATE_PAYMENT,
            [
                'mode' => '0011',
                'payerReference' => $payerReference,
                'callbackURL' => $callbackUrl,
                'amount' => $amount,
                'currency' => $currency,
                'intent' => $intent,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'merchantAssociationInfo' => $merchantAssociationInfo
            ]
        );
    }

    public function createPaymentForAgreement(
        $request_type,
        $payerReference,
        $agreementID,
        $amount,
        $merchantInvoiceNumber,
        $merchantAssociationInfo,
        $currency = 'BDT'
    ) {
        $intent = config(BkashConstant::INTENT);

        if(empty(env('BKASH_TOKENIZED_CALL_BACK_URL'))) {
            return [
                'statusCode' => "500",
                'statusMessage' => 'Please provide callback url in your env file.'
            ];
        } else {
            $callbackUrl = env('BKASH_TOKENIZED_CALL_BACK_URL') . '?request_type=' . $request_type;
        }

        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_CREATE_PAYMENT,
            [
                'mode' => '0001',
                'payerReference' => $payerReference,
                'callbackURL' => $callbackUrl,
                'agreementID' => $agreementID,
                'amount' => $amount,
                'currency' => $currency,
                'intent' => $intent,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'merchantAssociationInfo' => $merchantAssociationInfo
            ]
        );
    }

    public function execute($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_EXECUTE_PAYMENT,
            [
                'paymentID' => $paymentID,
            ]
        );
    }

    public function queryPayment($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_QUERY_PAYMENT,
            [
                'paymentID' => $paymentID,
            ]
        );
    }

    public function capture($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_CAPTURE_PAYMENT,
            [
                'paymentID' => $paymentID
            ],
        );
    }

    public function void($paymentID)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_VOID_PAYMENT,
            [
                'paymentID' => $paymentID
            ],
        );
    }
}
