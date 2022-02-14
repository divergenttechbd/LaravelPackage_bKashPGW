<?php

namespace Divergent\Bkash\Apis\Tokenized;

use Divergent\Bkash\Apis\BaseApi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TokenizedBaseApi extends BaseApi
{
    private $tokenized_token;

    public function __construct($config)
    {
        parent::__construct($config);
        if (!Session::has('tokenized_token')) {
            $this->initToken();
        }
    }

    public function initToken()
    {
        $response = Http::withHeaders([
            'username' => $this->config['username'],
            'password' => $this->config['password'],
        ])->POST($this->baseUrl() . "token/grant", [
            "app_key" => $this->config['app_key'],
            "app_secret" => $this->config['app_secret']
        ]);

        Session::forget('tokenized_token');

        Session::put('tokenized_token', $response->json()['id_token']);
        Session::put('tokenized_expires_in', (time() + $response->json()['expires_in']));
    }

    public function subDomain()
    {
        return 'tokenized';
    }

    public function urlPrefix()
    {
        return '/tokenized/checkout/';
    }

    public function getToken()
    {
        if (Session::get('tokenized_expires_in') - time() > 0) {
            $this->tokenized_token = session('tokenized_token');
        } else {
            $this->initToken();
            $this->tokenized_token = session('tokenized_token');
        }
        return $this->tokenized_token;
    }
}
