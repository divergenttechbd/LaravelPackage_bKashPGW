<?php

namespace Divergent\Bkash\Consts;

final class BkashConstant
{
    public const CREATE_AGREEMENT = 'agreement';
    public const WITHOUT_AGREEMENT_PAYMENT = 'woa_payment';
    public const WITH_AGREEMENT_PAYMENT = 'wa_payment';
    public const PAYMENT = 'payment';

    public const CHECKOUT = 'bkash.checkout';
    public const TOKENIZED = 'bkash.tokenized';
    public const RECURRING = 'bkash.recurring';
    public const INTENT = 'bkash.intent';

    public const METHOD_POST = 'POST';
    public const METHOD_GET = 'GET';

    public const CHECKOUT_SUB_DOMAIN = 'checkout';
    public const CHECKOUT_URL_PREFIX = '/checkout/';  
    
    public const TOKENIZED_SUB_DOMAIN = 'tokenized';
    public const TOKENIZED_URL_PREFIX = '/tokenized/checkout/';

    public const DATETIME_FORMAT = 'd M, Y h:i:s A';
    public const GMT_DATE_FORMAT = 'Y-m-d\TH:i:s\Z';
}
