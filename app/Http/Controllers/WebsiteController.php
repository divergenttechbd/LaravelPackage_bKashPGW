<?php

namespace App\Http\Controllers;

use App\Models\B2BPayout;
use App\Models\RecurringSubscription;
use Divergent\Bkash\Models\PaymentHistory;
use Divergent\Bkash\Models\UserAgreementMapper;

class WebsiteController extends Controller
{
    public function refund()
    {
        return view('frontend.checkout.refund');
    }

    public function refundStatus()
    {
        return view('frontend.checkout.refund_status');
    }

    public function paymentHistory()
    {
        $histories = PaymentHistory::orderBy('id', 'desc')->get();
        return view('frontend.checkout.payment_history', compact('histories'));
    }

    public function paymentCapture()
    {
        return view('frontend.checkout.payment_capture');
    }

    public function paymentVoid()
    {
        return view('frontend.checkout.payment_void');
    }

    public function paymentStatus()
    {
        return view('frontend.checkout.payment_status');
    }

    public function searchTransaction()
    {
        return view('frontend.checkout.search_transaction');
    }

    public function intraAccountTransfer()
    {
        return view('frontend.checkout.intra_account_transfer');
    }

    public function b2cpayout()
    {
        return view('frontend.checkout.b2cpayout');
    }

    public function agreementHistory()
    {
        $userAgreements = UserAgreementMapper::orderBy('id', 'desc')->get();
        return view('frontend.tokenized.agreement_history', compact('userAgreements'));
    }

    public function agreementStatus()
    {
        return view('frontend.tokenized.agreement_status');
    }

    public function agreementCancel()
    {
        return view('frontend.tokenized.agreement_cancel');
    }

    public function tokenizedRefund()
    {
        return view('frontend.tokenized.refund');
    }

    public function tokenizedRefundStatus()
    {
        return view('frontend.tokenized.refund_status');
    }

    public function tokenizedPaymentCapture()
    {
        return view('frontend.tokenized.capture');
    }

    public function tokenizedPaymentVoid()
    {
        return view('frontend.tokenized.void');
    }

    public function subscriberHistory()
    {
        $subs = RecurringSubscription::orderBy('id', 'desc')->get();
        return view('frontend.recurring.history', compact('subs'));
    }

    public function subscriberQueryById()
    {
        return view('frontend.recurring.query');
    }

    public function subscriberCancelById()
    {
        return view('frontend.recurring.cancel');
    }

    public function subscriptionPaymentList()
    {
        return view('frontend.recurring.payment-list');
    }

    public function subscriptionPaymentRefund()
    {
        return view('frontend.recurring.refund');
    }

    public function subscriptionList()
    {
        return view('frontend.recurring.subs-list');
    }

    public function paymentSchedule()
    {
        return view('frontend.recurring.payment-schedule');
    }

    public function checkoutB2BPayout()
    {
        return view('frontend.checkout.b2bpayout');
    }

    public function checkoutQueryPayout()
    {
        return view('frontend.checkout.querypayout');
    }

    public function checkoutB2BPayoutHistory()
    {
        $payouts = B2BPayout::where('type', 'checkout')->orderBy('id', 'desc')->get();
        return view('frontend.checkout.b2b-history', compact('payouts'));
    }

    public function tokenizedB2BPayoutHistory()
    {
        $payouts = B2BPayout::where('type', 'tokenized')->orderBy('id', 'desc')->get();
        return view('frontend.tokenized.b2b-history', compact('payouts'));
    }

    public function tokenizedB2BPayout()
    {
        return view('frontend.tokenized.b2bpayout');
    }

    public function tokenizedQueryPayout()
    {
        return view('frontend.tokenized.querypayout');
    }

    public function tokenizedIntraAccountTransfer()
    {
        return view('frontend.tokenized.intra_account_transfer');
    }

    public function tokenizedB2CPayout()
    {
        return view('frontend.tokenized.b2cpayout');
    }

}
