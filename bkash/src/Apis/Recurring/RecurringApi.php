<?php

namespace Divergent\Bkash\Apis\Recurring;

use Divergent\Bkash\Consts\BkashConstant;
use Divergent\Bkash\Consts\EndPoints;
use Illuminate\Support\Facades\Http;

class RecurringApi {

    protected $config;
    protected $baseUrl = EndPoints::RECURRING_BASE_URL;
    public $currentTimestamp;

    public function __construct($config)
    {
        $this->config = $config;
        $this->currentTimestamp = gmdate(BkashConstant::GMT_DATE_FORMAT);
    }

    public function callApi($request, $requestUrl, $body = [])
    {
        $response = Http::withHeaders(
            [
                'version' => $this->config['version'],
                'channelId' => $this->config['channelId'],
                'timeStamp' => $this->currentTimestamp,
                'x-api-key' => $this->config['api_key'],
                'Content-Type' => 'application/json',
                'Aceept' => 'application/json'
            ],
        )->$request($this->baseUrl . $requestUrl, $body);

        return $response->json();
    }

}