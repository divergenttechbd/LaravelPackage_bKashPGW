<?php

namespace Divergent\Bkash\Apis\Tokenized;

use Divergent\Bkash\Apis\BaseApi;
use Divergent\Bkash\Apis\Tokenized\Traits\Agreement;
use Divergent\Bkash\Apis\Tokenized\Traits\Payment;
use Divergent\Bkash\Apis\Tokenized\Traits\Payout;
use Divergent\Bkash\Apis\Tokenized\Traits\Refund;
use Divergent\Bkash\Consts\BkashConstant;

class TokenizedApi extends BaseApi
{
    use Agreement, Payment, Payout, Refund;

    public function __construct()
    {
        parent::__construct(config(BkashConstant::TOKENIZED));
    }

    public function subDomain()
    {
        return BkashConstant::TOKENIZED_SUB_DOMAIN;
    }

    public function urlPrefix()
    {
        return BkashConstant::TOKENIZED_URL_PREFIX;
    }

}
