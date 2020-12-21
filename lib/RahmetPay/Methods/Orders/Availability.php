<?php

namespace RahmetPay\Methods\Orders;

use RahmetPay\Request\Guzzle\Base as HttpBase;

class Availability extends HttpBase
{
    const AVAILABILITY_PATH = "orders/v1/preorder/availability";

    /**
     * Доступность оплаты.
     */
    public function make()
    {
        return $this->get(self::AVAILABILITY_PATH);
    }
}
