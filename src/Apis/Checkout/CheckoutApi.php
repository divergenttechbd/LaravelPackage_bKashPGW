<?php

namespace Divergent\Bkash\Apis\Checkout;

use Divergent\Bkash\Apis\BaseApi;
use Divergent\Bkash\Apis\Checkout\Traits\Payment;
use Divergent\Bkash\Apis\Checkout\Traits\Payout;
use Divergent\Bkash\Apis\Checkout\Traits\Refund;
use Divergent\Bkash\Apis\Checkout\Traits\SupportOperation;
use Divergent\Bkash\Consts\BkashConstant;

class CheckoutApi extends BaseApi
{

    use Payment, Payout, Refund, SupportOperation;

    public function __construct()
    {
        parent::__construct(config(BkashConstant::CHECKOUT));
    }

    public function subDomain()
    {
        return BkashConstant::CHECKOUT_SUB_DOMAIN;
    }
    

    public function urlPrefix()
    {
        return BkashConstant::CHECKOUT_URL_PREFIX;
    }
}
