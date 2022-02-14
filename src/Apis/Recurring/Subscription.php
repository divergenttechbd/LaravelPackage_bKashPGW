<?php

namespace Divergent\Bkash\Apis\Recurring;

class Subscription extends RecurringBaseApi {

    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function create($responseBody)
    {
        return $this->callApi(
            'POST',
            'subscription',
            $responseBody
        );
    }

    public function queryBySubscriptionRequestID($subscriptionRequestId)
    {
        return $this->callApi(
            'GET',
            'subscriptions/request-id/' . $subscriptionRequestId
        );
    }
    
    public function queryBySubscriptionID($subscriptionId)
    {
        return $this->callApi(
            'GET',
            'subscriptions/' . $subscriptionId
        );
    }
    
    public function cancelSubscription($subscriptionId, $reason)
    {
        return $this->callApi(
            'DELETE',
            'subscriptions/' . $subscriptionId . '?reason=' . $reason
        );
    }

    public function subscriptionList($page, $size)
    {
        return $this->callApi(
            'GET',
            'subscriptions/' . $page . '/' . $size
        );
    }
}