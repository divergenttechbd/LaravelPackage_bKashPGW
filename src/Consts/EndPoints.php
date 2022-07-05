<?php

namespace Divergent\Bkash\Consts;

final class EndPoints
{
    public const RECURRING_BASE_URL = 'https://gateway.sbrecurring.pay.bka.sh/gateway/api/';

    public const GRANT_TOKEN = 'token/grant';

    public const CHECKOUT_CREATE_PAYMENT = 'payment/create';
    public const CHECKOUT_EXECUTE_PAYMENT = 'payment/execute/';
    public const CHECKOUT_QUERY_PAYMENT = 'payment/query/';
    public const CHECKOUT_CAPTURE_PAYMENT = 'payment/capture/';
    public const CHECKOUT_VOID_PAYMENT = 'payment/void/';

    public const CHECKOUT_B2C_PAYOUT = 'payment/b2cPayment';
    public const CHECKOUT_PAYOUT_INITIATE = 'payout/initiate';
    public const CHECKOUT_B2B_PAYOUT = 'payout/b2b';
    public const CHECKOUT_QUERY_PAYOUT = 'payout/query/';

    public const CHECKOUT_PAYMENT_REFUND = 'payment/refund';
    public const CHECKOUT_REFUND_STATUS = 'payment/refund';

    public const CHECKOUT_PAYMENT_SEARCH = 'payment/search/';
    public const CHECKOUT_ORG_BALANCE = 'payment/organizationBalance';
    public const CHECKOUT_INTRA_TRANSFER = 'payment/intraAccountTransfer';

    public const RECURRING_PAYMENT_LIST = 'subscription/payment/bySubscriptionId/';
    public const RECURRING_PAYMENT_INFO = 'subscription/payment/';
    public const RECURRING_PAYMENT_REFUND = 'subscription/payment/refund';
    public const RECURRING_PAYMENT_SCHEDULE = 'subscription/payment/schedule';
    public const RECURRING_SUBSCRIPTION_CREATE = 'subscription';
    public const RECURRING_SUBSCRIPTION_QUERY = 'subscriptions/request-id/';
    public const RECURRING_SUBSCRIPTION_QUERY_BY_ID = 'subscriptions/';
    public const RECURRING_SUBSCRIPTION_CANCEL = 'subscriptions/';
    public const RECURRING_SUBSCRIPTION_LIST = 'subscriptions/';

    public const TOKENIZED_CREATE_AGREEMENT = 'create';
    public const TOKENIZED_EXECUTE_AGREEMENT = 'execute';
    public const TOKENIZED_AGREEMENT_STATUS = 'agreement/status';
    public const TOKENIZED_AGREEMENT_CANCEL = 'agreement/cancel';

    public const TOKENIZED_CREATE_PAYMENT = 'create';
    public const TOKENIZED_EXECUTE_PAYMENT = 'execute';
    public const TOKENIZED_QUERY_PAYMENT = 'payment/status';
    public const TOKENIZED_CAPTURE_PAYMENT = 'payment/confirm/capture';
    public const TOKENIZED_VOID_PAYMENT = 'payment/confirm/void';

    public const TOKENIZED_PAYOUT_INITIAT = 'payout/initiate';
    public const TOKENIZED_B2B_PAYOUT = 'payout/b2b';
    public const TOKENIZED_B2C_PAYOUT = 'payout/b2c';
    public const TOKENIZED_INTRA_TRANSFER = 'payout/intraAccountTransfer';
    public const TOKENIZED_QUERY_PAYOUT = 'payout/query/';

    public const TOKENIZED_PAYMENT_REFUND = 'payment/refund';
    public const TOKENIZED_REFUND_STATUS = 'payment/refund';
}
