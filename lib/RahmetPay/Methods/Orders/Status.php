<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\Curl as CurlExceptions;
use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Exceptions\PropertyFormat as PropertyFormatExceptions;
use RahmetPay\Request\Curl\Base as CurlBase;

class Status extends CurlBase
{
    const STATUS_PATH = "orders/v1/preorder/status";

    /**
     * Проверка статуса.
     * @param array $data
     * @throws CurlExceptions
     * @throws PropertyFormatExceptions|PropertyNotFoundExceptions
     */
    public function make($data)
    {
        if (!is_array($data)) {
            throw new PropertyFormatExceptions('merchant_order_ids', 'array');
        }

        if (!$data['merchant_order_ids']) {
            throw new PropertyNotFoundExceptions('merchant_order_ids');
        }

        $this->post(self::STATUS_PATH, $data);
    }
}
