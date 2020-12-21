<?php

namespace RahmetPay\Request\Guzzle;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @return array
     */
    private function getDefaultOptions()
    {
        return [
            'connect_timeout' => 3,
            'timeout' => 2,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ];
    }

    /**
     * @param array $options
     */
    public function __construct($options = [])
    {
        $opt = \array_merge($this->getDefaultOptions(), $options);

        parent::__construct($opt);
    }
}