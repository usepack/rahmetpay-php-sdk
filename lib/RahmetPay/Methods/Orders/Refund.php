<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Request\Guzzle\Base as HttpBase;

class Refund extends HttpBase
{
    const STATUS_PATH = "orders/v1/preorder/status";

    /**
     * Проверка статуса.
     * @param mixed $merchantOrderId
     * @param integer $amount
     * @param null $idempotency
     * @return array
     */
    public function make($merchantOrderId, $amount, $idempotency = null)
    {
        $headers = [];

        if ($idempotency) {
            $headers = ['X-Idempotency-Key' => $idempotency];
        }

        return $this->post(self::STATUS_PATH, [
            'merchant_order_id' => $merchantOrderId,
            'amount' => $amount
        ], $headers);
    }
}
