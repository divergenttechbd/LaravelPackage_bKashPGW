<?php

namespace Divergent\Bkash\Apis;

use Divergent\Bkash\Consts\EndPoints;
use ErrorException;
use Illuminate\Support\Facades\Http;

abstract class BaseApi
{

    protected $config;
    protected $version;
    protected $env;
    protected $token = null;

    public function __construct($config)
    {
        $this->config = $config;
        $this->version = $config['version'];
        $this->env = $config['sandbox'] ? 'sandbox' : 'pay';
    }

    public function getToken()
    {
        $response = Http::withHeaders([
            'username' => $this->config['username'],
            'password' => $this->config['password'],
        ])->POST($this->baseUrl() . EndPoints::GRANT_TOKEN, [
            "app_key" => $this->config['app_key'],
            "app_secret" => $this->config['app_secret']
        ]);

        if ($response->successful()) {
            return [
                'token' => $response->json()['id_token'],
                'expires_in' => $response->json()['expires_in']
            ];
        } else {
            return [
                'statusCode' => $response->status(),
                'statusMessage' => $response->body()
            ];
        }
    }

    public function setToken($token)
    {
        if( empty($token) && !is_string($token) && $token != ""){
            throw new ErrorException("Unauthorized access", 401);
        }
        $this->token = $token;
    }

    public function baseUrl()
    {
        $api = $this->subDomain() . '.' . $this->env;
        return "https://" . $api . ".bka.sh/" . $this->version . $this->urlPrefix();
    }

    private function unauthorized()
    {
        return [
            'statusCode' => 401,
            'statusMessage' => "Unauthorized access."
        ];
    }

    public function callApi($method, $endpoint, $body = [], $tokenizedPayout = false)
    {
        if ($tokenizedPayout) {
            $baseurl = "https://" . $this->subDomain() . '.' . $this->env . ".bka.sh/" . $this->version . '/tokenized/';
        } else {
            $baseurl = $this->baseUrl();
        }
        if(empty($this->token)){
            return $this->unauthorized();
        }
        $response = Http::withHeaders(
            [
                'Authorization' => $this->token,
                'X-APP-Key' => $this->config['app_key'],
                'Content-Type' => 'application/json'
            ]
        )->$method($baseurl . $endpoint, $body);

        if ($response->successful()) {
            return $response->json();
        }
        else if($response->status() === 401){
            return $this->unauthorized();
        }
        else {
            return [
                'statusCode' => $response->status(),
                'statusMessage' => $response->body()
            ];
        }
    }

    abstract protected function subDomain();

    abstract protected function urlPrefix();
}
