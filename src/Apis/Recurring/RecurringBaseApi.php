<?php

namespace Divergent\Bkash\Apis\Recurring;

use App\Models\ActivityLog;
use Divergent\Bkash\BkashLog;
use Illuminate\Support\Facades\Http;

class RecurringBaseApi {

    protected $config;
    protected $baseUrl = 'https://gateway.sbrecurring.pay.bka.sh/gateway/api/';
    public $currentTimestamp;

    public function __construct($config)
    {
        $this->config = $config;
        $this->currentTimestamp = gmdate("Y-m-d\TH:i:s\Z");
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

        // $content = 'API URL = ' . $this->baseUrl . $requestUrl . "\n DATE TIME = " . date('d M, Y h:i:s A') . "\n RESPONSE = " . json_encode($response->json())  . "\n ------------------------------------------------------------------------------------------------------------------------ \n\n";
        // $log = new ActivityLog();
        // $log->api_url = $this->baseUrl . $requestUrl;
        // $log->date_time = date('d M, Y h:i:s A');
        // $log->response = json_encode($response->json());
        // $log->save();

        //BkashLog::writeLog($content);

        return $response->json();
    }

}