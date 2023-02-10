<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Exceptions\PropertyFormat as PropertyFormatExceptions;
use RahmetPay\Methods\BaseMethods;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Status extends HttpBase implements BaseMethods
{
    const STATUS_PATH = "orders/v1/preorder/status";

    /**
     * Проверка статуса.
     * @param array $params
     * @return array
     * @throws PropertyFormatExceptions|PropertyNotFoundExceptions
     */
    public function make($params)
    {
        $this->validation($params);

        return $this->postRequest(self::STATUS_PATH, $params);
    }

    /**
     * @param array $params
     * @throws PropertyNotFoundExceptions|PropertyFormatExceptions
     */
    private function validation($params)
    {
        if (!$params['merchant_order_ids'] || empty($params['merchant_order_ids'])) {
            throw new PropertyNotFoundExceptions('merchant_order_ids');
        }

        if (!is_array($params)) {
            throw new PropertyFormatExceptions('merchant_order_ids', 'array');
        }
    }
}
