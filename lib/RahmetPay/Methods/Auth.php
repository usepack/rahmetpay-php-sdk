<?php

namespace RahmetPay\Methods;

use RahmetPay\Request\Guzzle\Base as HttpBase;

class Auth extends HttpBase
{
    const AUTH_PATH = "auth/token";

    /**
     * Авторизация.
     * @param $clientId
     * @param $clientSecret
     * @return array
     */
    public function make($clientId, $clientSecret)
    {
        return $this->post(self::AUTH_PATH, [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret
        ]);
    }
}
