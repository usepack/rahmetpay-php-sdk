<?php

namespace RahmetPay;

use RahmetPay\Methods\Auth;
use RahmetPay\Methods\Orders\Availability;
use RahmetPay\Methods\Orders\Create as OrderCreate;
use RahmetPay\Methods\Orders\Status as OrderStatus;
use RahmetPay\Methods\Orders\Refund as OrderRefund;

class Client
{
    /**
     * @var string
     */
    protected $bearerToken;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var array
     */
    protected $options;

    /**
     * @return string
     */
    public function getBearerToken()
    {
        return $this->bearerToken;
    }

    /**
     * @param string $bearerToken
     */
    public function setBearerToken($bearerToken)
    {
        $this->bearerToken = $bearerToken;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function __construct($basePath, $bearerToken, $options = [])
    {
        $this->setBearerToken($bearerToken);
        $this->setBasePath($basePath);
        $this->setOptions($options);
    }

    public function getAllOptions()
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getBearerToken()
            ],
            'base_uri' => $this->getBasePath()
        ];

        return \array_merge($options, $this->getOptions());
    }

    /**
     * @param $clientId
     * @param $clientSecret
     * @return array
     */
    public function auth($clientId, $clientSecret)
    {
        return (new Auth($this->getAllOptions()))->make($clientId, $clientSecret);
    }

    /**
     * @return array
     */
    public function availability()
    {
        return (new Availability($this->getAllOptions()))->make();
    }

    /**
     * @param array $requestData
     * @return array
     * @throws Exceptions\PropertyNotFound
     */
    public function create($requestData)
    {
        return (new OrderCreate($this->getAllOptions()))->make($requestData);
    }

    /**
     * @param array $requestData
     * @return array
     * @throws Exceptions\PropertyNotFound|Exceptions\PropertyFormat
     */
    public function status($requestData)
    {
        return (new OrderStatus($this->getAllOptions()))->make($requestData);
    }

    /**
     * @param $merchantOrderId
     * @param $amount
     * @param null $idempotency
     * @return array
     */
    public function refund($merchantOrderId, $amount, $idempotency = null)
    {
        return (new OrderRefund($this->getAllOptions()))->make($merchantOrderId, $amount, $idempotency);
    }
}