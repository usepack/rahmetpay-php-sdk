<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\PropertyNotFound as PropertyNotFoundExceptions;
use RahmetPay\Methods\BaseMethods;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Refund extends HttpBase implements BaseMethods
{
    const STATUS_PATH = "orders/v1/preorder/status";

    /**
     * Проверка статуса.
     * @param $params
     * @return array
     * @throws PropertyNotFoundExceptions
     */
    public function make($params)
    {
        $this->validation($params);

        $headers = [];

        if ($params['idempotency']) {
            $headers = ['X-Idempotency-Key' => $params['idempotency']];
        }

        return $this->post(self::STATUS_PATH, [
            'merchant_order_id' => $params['merchant_order_id'],
            'amount' => $params['amount']
        ], $headers);
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
    }
}
