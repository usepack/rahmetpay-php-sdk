<?php

namespace RahmetPay\Exceptions;

use Exception;

class Curl extends Exception
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
