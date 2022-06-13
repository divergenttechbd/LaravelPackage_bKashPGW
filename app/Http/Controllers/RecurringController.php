<?php

namespace App\Http\Controllers;

use App\Models\RecurringSubscription;
use Divergent\Bkash\Apis\Recurring\Payment;
use Divergent\Bkash\Apis\Recurring\Subscription;
use Divergent\Bkash\Consts\BkashConstant;
use Illuminate\Http\Request;

class RecurringController extends Controller
{

    private $subscriptionClass;
    private $payment;

    public function __construct()
    {
        $this->subscriptionClass = new Subscription();
        $this->payment = new Payment();
    }

    public function subscription()
    {
        return view('frontend.recurring.subscription');
    }

    public function create(Request $request)
    {
        $conf = config(BkashConstant::RECURRING);
        $redirectUrl = $conf['redirect_url'];
        $merchantShortCode  = $conf['merchant_short_code'];
        $serviceId = $conf['serviceId'];
        $paymentType = $conf['paymentType'];
        $amountQueryUrl = $conf['amountQueryUrl'];
        $maxCapAmount = $conf['maxCapAmount'];
        $maxCapRequired = $conf['maxCapRequired'];
        $payerType = $conf['payerType'];
        $payer = $conf['payer'];

        $data = [
            "subscriptionRequestId" => $request->subscriptionRequestId,
            "serviceId" => $serviceId,
            "paymentType" => $paymentType,
            "subscriptionType" => $request->subscriptionType,
            "amountQueryUrl" => $amountQueryUrl,
            "amount" => $request->amount,
            "firstPaymentAmount" => $request->firstPaymentAmount,
            "currency" => 'BDT',
            "firstPaymentIncludedInCycle" => $request->firstPaymentIncludedInCycle,
            "maxCapAmount" => $maxCapAmount,
            "maxCapRequired" => $maxCapRequired,
            "frequency" => $request->frequency,
            "startDate" => $request->startDate,
            "expiryDate" => $request->expiryDate,
            "payerType" => $payerType,
            "payer" => $payer,
            "subscriptionReference" => $request->subscriptionReference,
            "extraParams" => null,
            "redirectUrl" => $redirectUrl,
            "merchantShortCode" => $merchantShortCode
        ];

        //dd($data);

        $create = $this->subscriptionClass->create($data);

        if (!empty($create)) {
            if (!array_key_exists('subscriptionRequestId', $create)) {
                return redirect('/')->with('error', $create['status'] . '. Please try again later!');
            } else {
                //store data in db table
                $subs = new RecurringSubscription();
                $subs->response = json_encode($create);
                $subs->save();
                return redirect($create['redirectURL']);
            }
        } else {
            return redirect('/')->with('error', 'Something went wrong!');
        }
    }

    public function redirectUrl()
    {
        $data = $_GET;
        if ($data['status'] == 'SUCCEEDED') {
            return redirect('/')->with('success', 'Payment completed successfully!');
        }
        return redirect('/')->with('error', 'Payment failed. please try again!');
    }

    public function subscriptionQueryByReqId($requestId)
    {
        return $this->subscriptionClass->queryBySubscriptionRequestID($requestId);
    }

    public function subscriptionQueryById(Request $request)
    {
        return $this->subscriptionClass->queryBySubscriptionID($request->subscriptionID);
    }

    public function subscriptionCancelById(Request $request)
    {
        return $this->subscriptionClass->cancelSubscription($request->subscriptionID,  $request->reason);
    }

    public function paymentListById(Request $request)
    {
        $response = $this->payment->paymentListBySubscriptionID($request->subscriptionID);
        $response = json_decode(json_encode($response));
        return view('frontend.recurring.payment-list-table', compact('response'));
    }

    public function paymentInfoById($paymentId)
    {
        return $this->payment->paymentInfoByPaymentID($paymentId);
    }

    public function paymentRefund(Request $request)
    {
        return $this->payment->refund($request->paymentId, $request->amount);
    }

    public function subscriptionList(Request $request)
    {
        return $this->subscriptionClass->subscriptionList($request->page, $request->size);
    }

    public function paymentSchedule(Request $request)
    {
        return $this->payment->schedule($request->frequency, $request->startDate, $request->expiryDate);
    }
}
