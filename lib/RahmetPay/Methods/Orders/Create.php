<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Create extends HttpBase
{
    const CREATE_PATH = "orders/v1/preorder/create";

    /**
     * Создание заказа.
     * @param array $data
     * @return array
     * @throws PropertyNotFoundExceptions
     */
    public function make($data)
    {
        if (!$data['merchant_order_id'] || empty($data['merchant_order_id'])) {
            throw new PropertyNotFoundExceptions('merchant_order_id');
        }

        if (!$data['amount'] || empty($data['amount'])) {
            throw new PropertyNotFoundExceptions('amount');
        }

        if (!$data['token'] || empty($data['token'])) {
            throw new PropertyNotFoundExceptions('token');
        }

        return $this->post(self::CREATE_PATH, $data);
    }
}
