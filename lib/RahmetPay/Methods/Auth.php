<?php

namespace RahmetPay\Methods;

use RahmetPay\Exceptions\PropertyNotFound;
use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Auth extends HttpBase implements BaseMethods
{
    const AUTH_PATH = "auth/token";

    /**
     * Авторизация.
     * @param array $params
     * @return array
     * @throws PropertyNotFoundExceptions
     */
    public function make($params)
    {
        $this->validation($params);

        return $this->post(self::AUTH_PATH, [
            'grant_type' => 'client_credentials',
            'client_id' => $params['client_id'],
            'client_secret' => $params['client_secret']
        ]);
    }

    /**
     * @param array $params
     * @throws PropertyNotFound
     */
    private function validation($params)
    {
        if (!$params['client_id'] || empty($params['client_id'])) {
            throw new PropertyNotFoundExceptions('client_id');
        }

        if (!$params['client_secret'] || empty($params['client_secret'])) {
            throw new PropertyNotFoundExceptions('client_secret');
        }
    }
}
