<?php

namespace Divergent\Bkash\Apis\Tokenized\Traits;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

trait Agreement
{
    public function createAgreement(
        $request_type,
        $payerReference,
        $amount = '',
        $merchantInvoiceNumber,
        $currency = 'BDT'
    ) {
        $intent = config(BkashConstant::INTENT);

        $mode = '0000';

        $dataArray = array(
            'request_type' => $request_type,
            'payerReference' => $payerReference,
            'amount' => $amount,
            'merchantInvoiceNumber' => $merchantInvoiceNumber,
            'currency' => $currency,
            'intent' => $intent
        );

        if(empty(env('BKASH_TOKENIZED_CALL_BACK_URL'))) {
            return [
                'statusCode' => "500",
                'statusMessage' => 'Please provide callback url in your env file.'
            ];
        } else {
            $callbackUrl = env('BKASH_TOKENIZED_CALL_BACK_URL') . '?' . http_build_query($dataArray);
        }

        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_CREATE_AGREEMENT,
            [
                'mode' => $mode,
                'payerReference' => $payerReference,
                'callbackURL' => $callbackUrl,
                'amount' => $amount,
                'currency' => $currency,
                'intent' => $intent,
                'merchantInvoiceNumber' => $merchantInvoiceNumber
            ]
        );
    }

    public function executeAgreement(
        $paymentID
    ) {
        $execute = $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_EXECUTE_AGREEMENT,
            [
                'paymentID' => $paymentID,
            ]
        );

        return $execute;
    }

    public function status($agreementId)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_AGREEMENT_STATUS,
            [
                'agreementID' => $agreementId,
            ]
        );
    }

    public function cancel($agreementId)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::TOKENIZED_AGREEMENT_CANCEL,
            [
                'agreementID' => $agreementId,
            ]
        );
    }
}
