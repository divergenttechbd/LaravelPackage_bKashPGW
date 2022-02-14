<?php

namespace Divergent\Bkash\Apis\Tokenized;

use Divergent\Bkash\BkashConstant;

class Payment extends TokenizedBaseApi
{
    public function create($request_type, $payerReference, $amount, $merchantInvoiceNumber, $agreementID, $currency = 'BDT')
    {
        $callbackUrl = is_null(env('BKASH_TOKENIZED_CALL_BACK_URL')) ? asset('/customer/tokenized/agreement/callback') : env('BKASH_TOKENIZED_CALL_BACK_URL') . '?request_type=' . $request_type;
        $create = $this->callApi(
            'POST',
            'create',
            [
                'mode' => '0001',
                'payerReference' => $payerReference,
                'callbackURL' => $callbackUrl,
                'agreementID' => $agreementID,
                'amount' => $amount,
                'currency' => $currency,
                'intent' => config(BkashConstant::INTENT),
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'merchantAssociationInfo' => ''
            ]
        );

        return redirect($create['bkashURL']);
    }

    public function execute($paymentID)
    {
        return $this->callApi(
            'POST',
            'execute',
            [
                'paymentID' => $paymentID,
            ]
        );
    }

    public function queryPayment($paymentID)
    {
        return $this->callApi(
            'POST',
            'payment/status',
            [
                'paymentID' => $paymentID,
            ]
        );
    }

    public function capture($paymentID)
    {
        return $this->callApi(
            'POST',
            'payment/confirm/capture',
            [
                'paymentID' => $paymentID
            ],
        );
    }

    public function void($paymentID)
    {
        return $this->callApi(
            'POST',
            'payment/confirm/void',
            [
                'paymentID' => $paymentID
            ],
        );
    }
}
