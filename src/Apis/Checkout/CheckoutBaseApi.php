<?php

namespace Divergent\Bkash\Apis\Checkout;

use Divergent\Bkash\Apis\BaseApi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CheckoutBaseApi extends BaseApi
{
    private $token;

    public function __construct($config)
    {
        parent::__construct($config);
        if (!Session::has('token')) {
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

        Session::forget('token');

        Session::put('token', $response->json()['id_token']);
        Session::put('expires_in', (time() + $response->json()['expires_in']));
    }

    public function getToken()
    {
        if (Session::get('expires_in') - time() > 0) {
            $this->token = session('token');
        } else {
            $this->initToken();
            $this->token = session('token');
        }
        return $this->token;
    }

    public function subDomain()
    {
        return 'checkout';
    }

    public function urlPrefix()
    {
        return '/checkout/';
    }
}
