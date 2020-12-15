<?php

namespace RahmetPay;

use RahmetPay\Methods\Auth;
use RahmetPay\Methods\Orders\Availability;
use RahmetPay\Methods\Orders\Create as OrderCreate;
use RahmetPay\Methods\Orders\Status as OrderStatus;
use RahmetPay\Methods\Orders\Refund as OrderRefund;

class Base
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

    public function __construct($basePath, $bearerToken)
    {
        $this->setBearerToken($bearerToken);
        $this->setBasePath($basePath);
    }

    /**
     * @param $clientId
     * @param $clientSecret
     * @return string
     * @throws Exceptions\Curl
     */
    public function auth($clientId, $clientSecret)
    {
        $resource = (new Auth());
        $resource->setBearerToken($this->getBearerToken());
        $resource->setBasePath($this->getBasePath());
        $resource->make($clientId, $clientSecret);

        return $resource->getResponse();
    }

    /**
     * @return string
     * @throws Exceptions\Curl
     */
    public function availability()
    {
        $resource = (new Availability());
        $resource->setBearerToken($this->getBearerToken());
        $resource->setBasePath($this->getBasePath());
        $resource->make();

        return $resource->getResponse();
    }

    /**
     * @param array $requestData
     * @return string
     * @throws Exceptions\Curl
     * @throws Exceptions\PropertyNotFound
     */
    public function create($requestData)
    {
        $resource = (new OrderCreate());
        $resource->setBearerToken($this->getBearerToken());
        $resource->setBasePath($this->getBasePath());
        $resource->make($requestData);

        return $resource->getResponse();
    }

    /**
     * @param array $requestData
     * @throws Exceptions\Curl
     * @throws Exceptions\PropertyNotFound|Exceptions\PropertyFormat
     */
    public function status($requestData)
    {
        $resource = (new OrderStatus());
        $resource->setBearerToken($this->getBearerToken());
        $resource->setBasePath($this->getBasePath());
        $resource->make($requestData);

        return $resource->getResponse();
    }

    /**
     * @param $merchantOrderId
     * @param $amount
     * @param null $idempotency
     * @return string
     * @throws Exceptions\Curl
     */
    public function refund($merchantOrderId, $amount, $idempotency = null)
    {
        $resource = (new OrderRefund());
        $resource->setBearerToken($this->getBearerToken());
        $resource->setBasePath($this->getBasePath());
        $resource->make($merchantOrderId, $amount, $idempotency);

        return $resource->getResponse();
    }
}