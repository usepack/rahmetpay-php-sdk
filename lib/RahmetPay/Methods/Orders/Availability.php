<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Exceptions\Curl as CurlExceptions;
use RahmetPay\Request\Curl\Base as CurlBase;

class Availability extends CurlBase
{
    const AVAILABILITY_PATH = "orders/v1/preorder/availability";

    /**
     * Доступность оплаты.
     * @throws CurlExceptions
     */
    public function make()
    {
        $this->get(self::AVAILABILITY_PATH);
    }
}
