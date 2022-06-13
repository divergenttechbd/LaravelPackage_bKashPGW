<?php
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RecurringController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TokenizedController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WebsiteController;
use Divergent\Bkash\Models\PaymentHistory;
use Divergent\Bkash\Models\UserAgreementMapper;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('backend.dashboard');
});

//=================================== START Website PANEL ============================================
Route::get('refund', [WebsiteController::class, 'refund'])->name('refund');
Route::get('refund/status', [WebsiteController::class, 'refundStatus'])->name('refund.status');
Route::get('payment/history', [WebsiteController::class, 'paymentHistory'])->name('payment.history');
Route::get('payment/capture', [WebsiteController::class, 'paymentCapture'])->name('payment.capture');
Route::get('payment/void', [WebsiteController::class, 'paymentVoid'])->name('payment.void');
Route::get('payment/status', [WebsiteController::class, 'paymentStatus'])->name('payment.status');
Route::get('search/transaction', [WebsiteController::class, 'searchTransaction'])->name('search.transaction');
Route::get('intra-account/transfer', [WebsiteController::class, 'intraAccountTransfer'])->name('disbursement.intra-account.transfer');
Route::get('b2cpayout', [WebsiteController::class, 'b2cpayout'])->name('disbursement.b2cpayout');
Route::get('agreement/history', [WebsiteController::class, 'agreementHistory'])->name('website.agreement.history');
Route::get('agreement/status', [WebsiteController::class, 'agreementStatus'])->name('website.agreement.status');
Route::get('agreement/cancel', [WebsiteController::class, 'agreementCancel'])->name('website.agreement.cancel');
Route::get('tokenized/refund', [WebsiteController::class, 'tokenizedRefund'])->name('website.tokenized.refund');
Route::get('tokenized/refund/status', [WebsiteController::class, 'tokenizedRefundStatus'])->name('website.tokenized.refund-status');
Route::get('tokenized/payment/capture', [WebsiteController::class, 'tokenizedPaymentCapture'])->name('website.tokenized.capture');
Route::get('tokenized/payment/void', [WebsiteController::class, 'tokenizedPaymentVoid'])->name('website.tokenized.void');
Route::get('subscriber/history', [WebsiteController::class, 'subscriberHistory'])->name('subscriber.history');
Route::get('subscriber/query', [WebsiteController::class, 'subscriberQueryById'])->name('subscriber.query.id');
Route::get('subscriber/cancel', [WebsiteController::class, 'subscriberCancelById'])->name('subscriber.cancel.id');
Route::get('subscription/payment/list', [WebsiteController::class, 'subscriptionPaymentList'])->name('subscription.payment.list');
Route::get('subscription/payment/refund', [WebsiteController::class, 'subscriptionPaymentRefund'])->name('subscription.payment.refund');
Route::get('subscription/list', [WebsiteController::class, 'subscriptionList'])->name('subscription.list.page-size');
Route::get('payment/schedule', [WebsiteController::class, 'paymentSchedule'])->name('subscription.payment.schedule');
Route::get('checkout/b2bpayout', [WebsiteController::class, 'checkoutB2BPayout'])->name('website.checkout.b2bpayout');
Route::get('checkout/b2bpayout/history', [WebsiteController::class, 'checkoutB2BPayoutHistory'])->name('website.checkout.b2bpayout.history');
Route::get('checkout/querypayout', [WebsiteController::class, 'checkoutQueryPayout'])->name('website.checkout.querypayout');

Route::get('tokenized/intra-account/transfer', [WebsiteController::class, 'tokenizedIntraAccountTransfer'])->name('tokenized.intra-account.transfer');
Route::get('tokenized/b2cpayout', [WebsiteController::class, 'tokenizedB2CPayout'])->name('website.tokenized.b2cpayout');
Route::get('tokenized/b2bpayout', [WebsiteController::class, 'tokenizedB2BPayout'])->name('website.tokenized.b2bpayout');
Route::get('tokenized/b2bpayout/history', [WebsiteController::class, 'tokenizedB2BPayoutHistory'])->name('website.tokenized.b2bpayout.history');
Route::get('tokenized/querypayout', [WebsiteController::class, 'tokenizedQueryPayout'])->name('website.tokenized.querypayout');

//Webhook
Route::post('bkash/webhook', [WebhookController::class, 'requestWebhook'])->name('bkash.webhook');
Route::post('bkash/webhook/recurring', [WebhookController::class, 'requestRecurringWebhook'])->name('bkash.recurring.webhook');

//=================================== END Website PANEL ============================================

//=================================== START MARCHANT PANEL ============================================
Route::group(['prefix' => 'admin'], function () {

    Route::get('log', function () {
        return view('frontend.log');
    })->name('log');

    //Dashboard
    Route::get('dashboard', function () {
        $histories = PaymentHistory::orderBy('id', 'desc')->get();
        return view('bkash.dashboard', compact('histories'));
    });

    //Refund
    Route::post('refund', [PaymentController::class, 'refundTransaction'])->name('checkout.refund');
    Route::post('refund-status', [PaymentController::class, 'refundStatus'])->name('checkout.refund.status');

    //Payment
    Route::post('checkout/query-payment', [PaymentController::class, 'queryPayment'])->name('checkout.payment.status');
    Route::post('checkout/search-transaction', [PaymentController::class, 'searchTransaction'])->name('checkout.search.transaction');
    Route::post('checkout/capture', [PaymentController::class, 'capture'])->name('checkout.capture');
    Route::post('checkout/void', [PaymentController::class, 'void'])->name('checkout.void');
    Route::get('query-org-bl', [PaymentController::class, 'queryOrgBalance'])->name('disbursement.query-org-balance');
    Route::post('intra-transfer', [PaymentController::class, 'intraAccountTransfer'])->name('disbursement.intra-account-transfer');
    Route::post('b2c-payout', [PaymentController::class, 'b2cPayout'])->name('disbursement.b2cPayout');
    Route::post('checkout/b2b-payout', [PaymentController::class, 'b2bPayout'])->name('disbursement.checkout.b2bPayout');
    Route::post('checkout/query/payout', [PaymentController::class, 'queryPayout'])->name('disbursement.checkout.queryPayout');

    //Tokenized
    Route::group(['prefix' => 'tokenized'], function () {
        //Dashboard
        Route::get('dashboard', function () {
            $userAgreements = UserAgreementMapper::orderBy('id', 'desc')->get();
            return view('bkash.tokenized_dashboard', compact('userAgreements'));
        });

        //Payout
        Route::post('intra-account-transfer', [TokenizedController::class, 'intraAccountTransfer'])->name('tokenized.intra-account-transfer');
        Route::post('b2b-payout', [TokenizedController::class, 'b2bPayout'])->name('disbursement.tokenized.b2bPayout');
        Route::post('b2c-payout', [TokenizedController::class, 'b2cPayout'])->name('disbursement.tokenized.b2cPayout');
        Route::post('query/payout', [TokenizedController::class, 'queryPayout'])->name('disbursement.tokenized.queryPayout');

        //Refund
        Route::post('tokenized/refund', [TokenizedController::class, 'refundTransaction'])->name('tokenized.refund');
        Route::post('tokenized/refund-status', [TokenizedController::class, 'refundStatus'])->name('tokenized.refund.status');

        //Auth & Capture
        Route::post('tokenized/capture', [TokenizedController::class, 'capture'])->name('tokenized.capture');
        Route::post('tokenized/void', [TokenizedController::class, 'void'])->name('tokenized.void');

        //Agreement
        Route::group(['prefix' => 'agreement'], function () {
            Route::post('status', [AgreementController::class, 'status'])->name('agreement.status');
            Route::post('cancel', [AgreementController::class, 'cancel'])->name('agreement.cancel');
        });
    });
});
//================================== END MARCHANT PANEL ==============================================

//----------------------------------------------------------------------------------------------------

//=============================== START CUSTOMER/USER PANEL ===========================================
Route::group(['prefix' => 'customer'], function () {

    //Checkout (iFrame)
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('products', function () {
            return view('frontend.checkout.products');
        });
        //Payment    
        Route::post('create', [PaymentController::class, 'create']);
        Route::post('execute', [PaymentController::class, 'execute']);
        Route::get('{status}/{messge}', [PaymentController::class, 'response']);
    });

    //Tokenized
    Route::group(['prefix' => 'tokenized'], function () {
        Route::get('products/{is_with_agreement}', function ($is_with_agreement) {
            return view('frontend.tokenized.tokenized_products', compact('is_with_agreement'));
        })->name('tokenized.products');
        //Agreement
        Route::group(['prefix' => 'agreement'], function () {
            Route::post('create', [AgreementController::class, 'create'])->name('agreement.create');
            Route::get('callback', [AgreementController::class, 'callback'])->name('agreement.callback');
        });
        //Payment - without agreement (URL Base)
        Route::group(['prefix' => 'without/agreement/payment'], function () {
            Route::post('create', [TokenizedController::class, 'createWithOutAgreement'])->name('without-agreement.create');
        });
        //Payment - with agreement (URL Base)
        Route::group(['prefix' => 'with/agreement/payment'], function () {
            Route::post('create', [TokenizedController::class, 'createWithAgreement'])->name('with-agreement.create');
        });
    });

    //Recurring
    Route::group(['prefix' => 'recurring'], function () {

        Route::get('redirect_url', [RecurringController::class, 'redirectUrl'])->name('recurring.redirect_url');

        //Subscription
        Route::get('subscription', [RecurringController::class, 'subscription'])->name('recurring.subscription');
        Route::post('subscription/create', [RecurringController::class, 'create'])->name('recurring.subscription.create');
        Route::get('subscription/query/{requestId}', [RecurringController::class, 'subscriptionQueryByReqId'])->name('recurring.subscription.query.requestID');
        Route::post('query/subscription', [RecurringController::class, 'subscriptionQueryById'])->name('recurring.subscription.query.id');
        Route::post('cancel/subscription', [RecurringController::class, 'subscriptionCancelById'])->name('recurring.subscription.cancel.id');
        Route::post('subscription/list', [RecurringController::class, 'subscriptionList'])->name('recurring.subscription.list');

        //Payment
        Route::post('payment/list', [RecurringController::class, 'paymentListById'])->name('recurring.payment.list');
        Route::get('payment/info/{paymentId}', [RecurringController::class, 'paymentInfoById'])->name('recurring.payment.info');
        Route::post('payment/refund', [RecurringController::class, 'paymentRefund'])->name('recurring.payment.refund');
        Route::post('payment/refund', [RecurringController::class, 'paymentRefund'])->name('recurring.payment.refund');
        Route::post('payment/schedule', [RecurringController::class, 'paymentSchedule'])->name('recurring.payment.schedule');
    });
});


//=============================== END CUSTOMER/USER PANEL ===========================================