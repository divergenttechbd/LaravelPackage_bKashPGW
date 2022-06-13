<?php

namespace App\Http\Controllers;

use Divergent\Bkash\Apis\Tokenized\TokenizedApi;
use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Models\PaymentHistory;
use Divergent\Bkash\Models\UserAgreementMapper;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public $tokenized;

    public function __construct()
    {
        $this->tokenized = new TokenizedApi();
        $token = $this->tokenized->getToken();
        $this->tokenized->setToken($token['token']);
    }

    public function create(Request $request)
    {
        $loggedInUserId = 72;
        $countUserAgreement = UserAgreementMapper::where('user_id', $loggedInUserId)->count();
        if ($countUserAgreement != 0) {
            return back()->with('error', 'Agreement already created!');
        }

        $response = $this->tokenized->createAgreement(BkashConstant::CREATE_AGREEMENT, $request->payerReference, '', '');

        if ($response['statusCode'] == "0000") {
            header("Location: " . $response['bkashURL']);
            exit();
        } else {
            return redirect('/')->with('error', $response['statusMessage']);
        }
    }

    public function callback()
    {
        $data = $_GET;

        if ($data['request_type'] == BkashConstant::CREATE_AGREEMENT && $data['status'] == 'success') {
            $response = json_encode($this->tokenized->executeAgreement($data['paymentID']));
            $response = json_decode($response);

            if ($response->statusCode == "0000") {

                //Store Agreement Data
                $agreement = new UserAgreementMapper();
                $agreement->user_id = rand(1, 99);
                $agreement->agreement_id = $response->agreementID;
                $agreement->payment_id = $response->paymentID;
                $agreement->save();

                return redirect('/')->with('success', 'Agreement Created Successfully!');
            } else {
                return redirect('/')->with('error', $response->statusMessage);
            }
        } else if (($data['request_type'] == BkashConstant::WITHOUT_AGREEMENT_PAYMENT || $data['request_type'] == BkashConstant::PAYMENT) && $data['status'] == 'success') {

            $response = $this->tokenized->execute($data['paymentID']);

            //$response = json_decode($response);
            // echo "<pre>";
            // print_r($response);
            // die;

            if ($response['statusCode'] == "0000") {
                //Store Payment Data
                $paymentHistory = new PaymentHistory();

                $paymentHistory->paymentId = $response['paymentID'];
                $paymentHistory->createTime = $response['paymentExecuteTime'];
                $paymentHistory->updateTime = $response['paymentExecuteTime'];
                $paymentHistory->trxID = $response['trxID'];
                $paymentHistory->transactionStatus = $response['transactionStatus'];
                $paymentHistory->amount = $response['amount'];
                $paymentHistory->currency = $response['currency'];
                $paymentHistory->intent = $response['intent'];
                $paymentHistory->merchantInvoiceNumber = $response['merchantInvoiceNumber'];
                $paymentHistory->user_id = rand(1, 99);
                $paymentHistory->data = json_encode($response);
                $paymentHistory->save();

                return redirect('/')->with('success', 'Payment Completed Successfully!');
            } else {
                return redirect('/')->with('error', $response['statusMessage']);
            }
        } elseif ($data['request_type'] == BkashConstant::WITH_AGREEMENT_PAYMENT && $data['status'] == 'success') {

            $response = $this->tokenized->executeAgreement($data['paymentID']);
            //$response = json_decode($response);
            // echo "<pre>";
            // print_r($response);
            // die;

            if ($response['statusCode'] == "0000") {

                //Store Agreement Data
                $agreement = new UserAgreementMapper();
                $agreement->user_id = rand(1, 99);
                $agreement->agreement_id = $response['agreementID'];
                $agreement->payment_id = $response['paymentID'];
                $agreement->save();
                //End Store Agreement Data

                //Make Payment
                $paymentResponse = $this->tokenized->createPaymentForAgreement(
                    BkashConstant::PAYMENT,
                    $data['payerReference'],
                    $response['agreementID'],
                    $data['amount'],
                    $data['merchantInvoiceNumber'],
                    ''
                );
                //End Make Payment

                //redirect bkash url
                //$paymentResponse = json_decode($paymentResponse);
                header("Location: " . $paymentResponse['bkashURL']);
                exit();
            } else {
                return redirect('/')->with('success', $response['statusMessage']);
            }
        } else {
            return redirect('/')->with('error', 'Payment Failed! Please try again with correct information.');
        }
    }

    public function status(Request $request)
    {
        return $this->tokenized->status($request->agreementID);
    }

    public function cancel(Request $request)
    {
        $response = $this->tokenized->cancel($request->agreementID);
        if ($response['agreementStatus'] == 'Cancelled') {
            UserAgreementMapper::where('agreement_id', $response['agreementID'])->delete();
            return redirect('/')->with('error', 'Agreement Cancelled Successfully!');
        }
    }

    public function errorHandle($response)
    {
        $bkashErrorCode = [
            2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013,
            2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028,
            2030, 2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045,
            2046, 2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061,
            2062, 2063, 2064, 2065, 2066, 2067, 2068, 2069, 503
        ];
        if (in_array(intval($response->statusCode), $bkashErrorCode)) {
            return redirect('/')->with('error', 'Payment Failed! Please try again with correct information.');
        } elseif (intval($response->statusCode) == 2029) {
            return redirect('/')->with('error', 'Sorry, your payment was unsuccessful !!! For same amount transaction, please try again after 10 minutes.');
        }
    }
}
