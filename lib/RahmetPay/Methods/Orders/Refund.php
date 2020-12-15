<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\Curl as CurlExceptions;
use RahmetPay\Request\Curl\Base as CurlBase;

class Refund extends CurlBase
{
    const STATUS_PATH = "orders/v1/preorder/status";

    /**
     * Проверка статуса.
     * @param mixed $merchantOrderId
     * @param integer $amount
     * @param null $idempotency
     * @throws CurlExceptions
     */
    public function make($merchantOrderId, $amount, $idempotency = null)
    {
        $headers = [];

        if ($idempotency) {
            $headers = ['X-Idempotency-Key' => $idempotency];
        }

        $this->post(self::STATUS_PATH, [
            'merchant_order_id' => $merchantOrderId,
            'amount' => $amount
        ], $headers);
    }
}
