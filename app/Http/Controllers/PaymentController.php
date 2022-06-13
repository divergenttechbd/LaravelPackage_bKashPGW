<?php

namespace App\Http\Controllers;

use App\Models\B2BPayout;
use Divergent\Bkash\Apis\Checkout\CheckoutApi;
use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Models\PaymentHistory;
use Divergent\Bkash\Requests\BkashAmountRequest;
use Divergent\Bkash\Requests\BkashB2CPaymentRequest;
use Divergent\Bkash\Requests\BkashPaymentIDRequest;
use Divergent\Bkash\Requests\BkashRefundRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $checkout;

    public function __construct()
    {
        $this->checkout = new CheckoutApi();
        $token = $this->checkout->getToken();
        $this->checkout->setToken($token['token']);
    }

    public function create(Request $request)
    {
        $intent = config(BkashConstant::INTENT);
        return $this->checkout->create($request->amount, $request->invoice_no, $intent);
    }

    public function execute(Request $request)
    {
        return $this->checkout->execute($request->paymentID);
    }

    public function response($status, $message)
    {
        if ($status == 'success') {
            $data = json_decode($message);

            $history = new PaymentHistory();

            $history->paymentId = $data->paymentID;
            $history->createTime = $data->createTime;
            $history->updateTime = $data->updateTime;
            $history->trxID = $data->trxID;
            $history->transactionStatus = $data->transactionStatus;
            $history->amount = $data->amount;
            $history->currency = $data->currency;
            $history->intent = $data->intent;
            $history->merchantInvoiceNumber = $data->merchantInvoiceNumber;
            $history->user_id = rand(1, 99);
            $history->data = $message;
            $history->save();

            // $message = 'Payment Done Successfully!';
            // return view('bkash.response', compact('status', 'message'));
            return redirect('/')->with('success', 'Payment Done Successfully!');
        }
        //return view('bkash.response', compact('status', 'message'));
        return redirect('/')->with('error', $message);
    }

    public function refundTransaction(BkashRefundRequest $request)
    {
        return $this->checkout->refundTransaction(
            $request->paymentID,
            $request->amount,
            $request->trxID,
            $request->sku,
            $request->reason
        );
    }

    public function refundStatus(BkashPaymentIDRequest $request)
    {
        return $this->checkout->refundStatus(
            $request->paymentID,
            $request->trxID
        );
    }

    public function queryPayment(BkashPaymentIDRequest $request)
    {
        return $this->checkout->queryPayment($request->paymentID);
    }

    public function searchTransaction(Request $request)
    {
        return $this->checkout->searchTransaction($request->trxID);
    }

    public function capture(BkashPaymentIDRequest $request)
    {
        return $this->checkout->capture($request->paymentID);
    }

    public function void(BkashPaymentIDRequest $request)
    {
        return $this->checkout->void($request->paymentID);
    }

    public function queryOrgBalance()
    {
        return $this->checkout->queryOrgBalance();
    }

    public function intraAccountTransfer(BkashAmountRequest $request)
    {
        return $this->checkout->intraAccountTransfer($request->amount, $request->transferType);
    }

    public function b2cPayout(BkashB2CPaymentRequest $request)
    {
        return $this->checkout->b2cPayment($request->amount, $request->merchantInvoiceNumber, $request->receiverMSISDN);
    }

    public function b2bPayout(BkashB2CPaymentRequest $request)
    {
        $initPayout = $this->checkout->initiatePayout();
        $payoutID = $initPayout['payoutID'];
        $response = $this->checkout->b2bPayout($payoutID, $request->amount, $request->merchantInvoiceNumber, $request->receiverMSISDN);
        if (!isset($response['errorCode'])) {

            $b2b = new B2BPayout();

            $b2b->type = 'checkout';
            $b2b->data = json_encode($response);
            $b2b->save();
        }

        return $response;
    }

    public function queryPayout(Request $request)
    {
        return $this->checkout->queryPayout($request->payoutID);
    }
}
