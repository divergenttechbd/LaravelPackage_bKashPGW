<?php

namespace App\Http\Controllers;

use App\Models\WebhookPayload;
use Divergent\Bkash\Apis\Webhook\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function requestWebhook(Request $request)
    {      
        $webhookData = new WebhookPayload();
        $webhookData->product = 'webhook';
        $webhookData->response = json_encode($request->all());
        $webhookData->headers = json_encode($request->header());
        $webhookData->save();        

        $webhook = new Webhook();
        $data =  $webhook->processWebhookRequest($webhookData->id);
        return $data;
    }

    public function requestRecurringWebhook(Request $request)
    {

        $webhookData = new WebhookPayload();
        $webhookData->product = 'recurring';
        $webhookData->response = json_encode($request->all());
        $webhookData->headers = json_encode($request->header());
        $webhookData->save();
        
        $webhook = new Webhook();
        return $webhook->processRecurringWebhookRequest();
    }
}
