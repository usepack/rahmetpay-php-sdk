<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Exceptions\PropertyFormat as PropertyFormatExceptions;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Status extends HttpBase
{
    const STATUS_PATH = "orders/v1/preorder/status";

    /**
     * Проверка статуса.
     * @param array $data
     * @return array
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

        return $this->post(self::STATUS_PATH, $data);
    }
}
