<?php

namespace RahmetPay\Exceptions;

use Exception;

/**
 * Class PropertyFormat
 */
class PropertyFormat extends Exception
{
    /**
     * @param string $name extension name
     * @param $type
     * @param int $code error code
     */
    public function __construct($name, $type, $code = 0)
    {
        $message = 'Property '.$name.' must be type '.$type;
        parent::__construct($message, $code);
    }
}