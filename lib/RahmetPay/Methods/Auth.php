<?php

namespace RahmetPay\Methods;

use RahmetPay\Exceptions\Curl as CurlExceptions;
use RahmetPay\Request\Curl\Base as CurlBase;

class Auth extends CurlBase
{
    const AUTH_PATH = "auth/token";

    /**
     * Авторизация.
     * @param $clientId
     * @param $clientSecret
     * @throws CurlExceptions
     */
    public function make($clientId, $clientSecret)
    {
        $this->post(self::AUTH_PATH, [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret
        ]);
    }
}
