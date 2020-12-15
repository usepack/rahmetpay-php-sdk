<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\Curl as CurlExceptions;
use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Request\Curl\Base as CurlBase;

class Create extends CurlBase
{
    const CREATE_PATH = "orders/v1/preorder/create";

    /**
     * Создание заказа.
     * @param array $data
     * @throws CurlExceptions
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

        $this->post(self::CREATE_PATH, $data);
    }
}
