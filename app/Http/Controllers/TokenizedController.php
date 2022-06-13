<?php

namespace App\Http\Controllers;

use App\Models\B2BPayout;
use Divergent\Bkash\Apis\Tokenized\TokenizedApi;
use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Models\UserAgreementMapper;
use Divergent\Bkash\Requests\BkashAmountRequest;
use Divergent\Bkash\Requests\BkashB2CPaymentRequest;
use Divergent\Bkash\Requests\BkashPaymentIDRequest;
use Divergent\Bkash\Requests\BkashRefundRequest;
use Illuminate\Http\Request;

class TokenizedController extends Controller
{
    public $tokenized;

    public function __construct()
    {
        $this->tokenized = new TokenizedApi();
        $token = $this->tokenized->getToken();
        $this->tokenized->setToken($token['token']);
    }

    public function createWithOutAgreement(Request $request)
    {
        $response = $this->tokenized->create(
            config(BkashConstant::INTENT),
            BkashConstant::WITHOUT_AGREEMENT_PAYMENT,
            $request->payerReference,
            $request->amount,
            $request->invoice,
            ''
        );

        if ($response['statusCode'] == "0000") {
            header("Location: " . $response['bkashURL']);
            exit();
        } else {
            return redirect('/')->with('error', $response['statusMessage']);
        }
    }

    public function createWithAgreement(Request $request)
    {
        $response = $this->tokenized->createAgreement(
            BkashConstant::WITH_AGREEMENT_PAYMENT,
            $request->payerReference,
            $request->amount,
            $request->invoice,
            ''
        );
        if ($response['statusCode'] == "0000") {
            header("Location: " . $response['bkashURL']);
            exit();
        } else {
            return redirect('/')->with('error', $response['statusMessage']);
        }
    }

    public function capture(BkashPaymentIDRequest $request)
    {
        return $this->tokenized->capture($request->paymentID);
    }

    public function void(BkashPaymentIDRequest $request)
    {
        return $this->tokenized->void($request->paymentID);
    }

    public function refundTransaction(BkashRefundRequest $request)
    {
        return $this->tokenized->refundTransaction(
            $request->paymentID,
            $request->amount,
            $request->trxID,
            $request->sku,
            $request->reason
        );
    }

    public function refundStatus(BkashPaymentIDRequest $request)
    {
        return $this->tokenized->refundStatus(
            $request->paymentID,
            $request->trxID
        );
    }

    public function b2bPayout(BkashB2CPaymentRequest $request)
    {
        $initPayout = $this->tokenized->initiatePayout("B2B");
        $payoutID = $initPayout['payoutID'];
        $response = $this->tokenized->b2bPayout($payoutID, $request->amount, $request->merchantInvoiceNumber, $request->receiverMSISDN);
        if (!isset($response['statusCode'])) {

            $b2b = new B2BPayout();

            $b2b->type = 'tokenized';
            $b2b->data = json_encode($response);
            $b2b->save();
        }

        return $response;
    }

    public function b2cPayout(BkashB2CPaymentRequest $request)
    {
        $initPayout = $this->tokenized->initiatePayout("B2C");
        $payoutID = $initPayout['payoutID'];
        $response = $this->tokenized->b2cPayout($payoutID, $request->amount, $request->merchantInvoiceNumber, $request->receiverMSISDN);
        return $response;
    }

    public function intraAccountTransfer(BkashAmountRequest $request)
    {
        $initPayout = $this->tokenized->initiatePayout("INTRA");
        $payoutID = $initPayout['payoutID'];
        $response = $this->tokenized->intraAccountTransfer($payoutID, $request->amount, $request->transferType);
        return $response;
    }

    public function queryPayout(Request $request)
    {
        return $this->tokenized->queryPayout($request->payoutID);
    }
}
