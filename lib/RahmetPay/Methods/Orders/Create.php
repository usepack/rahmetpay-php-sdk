<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Methods\BaseMethods;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Create extends HttpBase implements BaseMethods
{
    const CREATE_PATH = "orders/v1/preorder/create";

    /**
     * Создание заказа.
     * @param array $params
     * @return array
     * @throws PropertyNotFoundExceptions
     */
    public function make($params)
    {
        $this->validation($params);

        return $this->postRequest(self::CREATE_PATH, $params);
    }

    /**
     * @param array $params
     * @throws PropertyNotFoundExceptions
     */
    private function validation($params)
    {
        if (!$params['merchant_order_id'] || empty($params['merchant_order_id'])) {
            throw new PropertyNotFoundExceptions('merchant_order_id');
        }

        if (!$params['amount'] || empty($params['amount'])) {
            throw new PropertyNotFoundExceptions('amount');
        }

        if (!$params['token'] || empty($params['token'])) {
            throw new PropertyNotFoundExceptions('token');
        }
    }
}
