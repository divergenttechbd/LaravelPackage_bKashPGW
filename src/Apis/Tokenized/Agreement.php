<?php

namespace Divergent\Bkash\Apis\Tokenized;

use Divergent\Bkash\BkashConstant;

class Agreement extends TokenizedBaseApi
{
    public function createAgreement(
        $request_type,
        $payerReference,
        $amount = '',
        $merchantInvoiceNumber = '',
        $currency = 'BDT',
        $merchantAssociationInfo = ''
    ) {
        $intent = config(BkashConstant::INTENT);
        $callbackUrl = is_null(env('BKASH_TOKENIZED_CALL_BACK_URL')) ? asset('/customer/tokenized/agreement/callback') : env('BKASH_TOKENIZED_CALL_BACK_URL') . '?request_type=' . $request_type;

        if ($request_type == BkashConstant::CREATE_AGREEMENT) {
            $mode = '0000';
        } elseif ($request_type == BkashConstant::WITHOUT_AGREEMENT_PAYMENT) {
            $mode = '0011';
        } elseif ($request_type == BkashConstant::WITH_AGREEMENT_PAYMENT) {
            $mode = '0000';
            $dataArray = array(
                'request_type' => $request_type,
                'payerReference' => $payerReference,
                'amount' => $amount,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'currency' => $currency,
                'intent' => $intent,
                'merchantAssociationInfo' => $merchantAssociationInfo
            );
            $callbackUrl = is_null(env('BKASH_TOKENIZED_CALL_BACK_URL')) ? asset('/customer/tokenized/agreement/callback') : env('BKASH_TOKENIZED_CALL_BACK_URL') . '?' . http_build_query($dataArray);
        }

        $create = $this->callApi(
            'POST',
            'create',
            [
                'mode' => $mode,
                'payerReference' => $payerReference,
                'callbackURL' => $callbackUrl,
                'amount' => $amount,
                'currency' => $currency,
                'intent' => $intent,
                'merchantInvoiceNumber' => $merchantInvoiceNumber,
                'merchantAssociationInfo' => $merchantAssociationInfo
            ]
        );

        return redirect($create['bkashURL']);
    }

    public function executeAgreement(
        $paymentID
    ) {
        $execute = $this->callApi(
            'POST',
            'execute',
            [
                'paymentID' => $paymentID,
            ]
        );

        return $execute;
    }

    public function status($agreementId)
    {
        return $this->callApi(
            'POST',
            'agreement/status',
            [
                'agreementID' => $agreementId,
            ]
        );
    }

    public function cancel($agreementId)
    {
        return $this->callApi(
            'POST',
            'agreement/cancel',
            [
                'agreementID' => $agreementId,
            ]
        );
    }
}
