<?php

namespace Divergent\Bkash\Apis\Recurring;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;

class Subscription extends RecurringApi {

    public function __construct()
    {
        parent::__construct(config(BkashConstant::RECURRING));
    }

    public function create($responseBody)
    {
        return $this->callApi(
            BkashConstant::METHOD_POST,
            EndPoints::RECURRING_SUBSCRIPTION_CREATE,
            $responseBody
        );
    }

    public function queryBySubscriptionRequestID($subscriptionRequestId)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::RECURRING_SUBSCRIPTION_QUERY . $subscriptionRequestId
        );
    }
    
    public function queryBySubscriptionID($subscriptionId)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::RECURRING_SUBSCRIPTION_QUERY_BY_ID . $subscriptionId
        );
    }
    
    public function cancelSubscription($subscriptionId, $reason)
    {
        return $this->callApi(
            'DELETE',
            EndPoints::RECURRING_SUBSCRIPTION_CANCEL . $subscriptionId . '?reason=' . $reason
        );
    }

    public function subscriptionList($page, $size)
    {
        return $this->callApi(
            BkashConstant::METHOD_GET,
            EndPoints::RECURRING_SUBSCRIPTION_LIST . $page . '/' . $size
        );
    }
}