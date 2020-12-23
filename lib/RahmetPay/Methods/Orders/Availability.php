<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Methods\BaseMethods;
use RahmetPay\Request\Guzzle\Base as HttpBase;

class Availability extends HttpBase implements BaseMethods
{
    const AVAILABILITY_PATH = "orders/v1/preorder/availability";

    /**
     * Доступность оплаты.
     * @param array $params
     * @return array
     */
    public function make($params = [])
    {
        return $this->get(self::AVAILABILITY_PATH);
    }
}
