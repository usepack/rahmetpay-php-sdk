<?php

namespace RahmetPay\Exceptions;

use Exception;

/**
 * Class PropertyNotFound
 */
class PropertyNotFound extends Exception
{
    /**
     * @param string $name extension name
     * @param int $code error code
     */
    public function __construct($name, $code = 0)
    {
        $message = 'Property '.$name.' required';
        parent::__construct($message, $code);
    }
}