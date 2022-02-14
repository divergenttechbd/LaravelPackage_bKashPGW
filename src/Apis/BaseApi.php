<?php

namespace Divergent\Bkash\Apis;

use App\Models\ActivityLog;
use Divergent\Bkash\BkashLog;
use Illuminate\Support\Facades\Http;

abstract class BaseApi
{

    protected $config;
    protected $version;
    protected $env;

    public function __construct($config)
    {
        $this->config = $config;
        $this->version = $config['version'];
        $this->env = $config['sandbox'] ? 'sandbox' : 'pay';
    }

    public function baseUrl()
    {
        $api = $this->subDomain() . '.' . $this->env;
        return "https://" . $api . ".bka.sh/" . $this->version . $this->urlPrefix();
    }

    public function callApi($request, $requestUrl, $body = [], $tokenizedPayout = false)
    {
        if ($tokenizedPayout) {
            $baseurl = "https://" . $this->subDomain() . '.' . $this->env . ".bka.sh/" . $this->version . '/tokenized/';
        } else {
            $baseurl = $this->baseUrl();
        }
        $response = Http::withHeaders(
            [
                'Authorization' => $this->getToken(),
                'X-APP-Key' => $this->config['app_key'],
            ],
        )->$request($baseurl . $requestUrl, $body);

        $content = 'API URL = ' . $baseurl . $requestUrl . "\n DATE TIME = " . date('d M, Y h:i:s A') . "\n RESPONSE = " . json_encode($response->json())  . "\n ------------------------------------------------------------------------------------------------------------------------ \n\n";
        $log = new ActivityLog();
        $log->api_url = $baseurl . $requestUrl;
        $log->date_time = date('d M, Y h:i:s A');
        $log->response = json_encode($response->json());
        $log->save();

        BkashLog::writeLog($content);

        return $response->json();
    }

    abstract protected function subDomain();

    abstract protected function urlPrefix();

    abstract protected function getToken();
}
