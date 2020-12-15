<?php

namespace RahmetPay\Request\Curl;

use RahmetPay\Exceptions\Curl as CurlException;

class Client
{
    /**
     * @var array
     */
    private $defaultHeaders = [
        'Content-Type: application/x-www-form-urlencoded',
    ];

    /**
     * @var resource
     */
    protected $curl;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var string
     */
    protected $bearerToken;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $response;

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
     * @return mixed
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * @param mixed $curl
     */
    public function setCurl($curl)
    {
        $this->curl = $curl;
    }

    /**
     * @param string $url
     */
    protected function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    private function setResponse($response)
    {
        $this->response = $response;
    }

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
     * CurlClient constructor.
     * @throws CurlException
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @return void
     * @throws CurlException
     */
    protected function init()
    {
        if (!extension_loaded('curl')) {
            throw new CurlException('curl extension is not loaded!');
        }

        if (!$this->getCurl()) {
            $this->setCurl(curl_init());
        }

        $this->setDefaults();
    }

    /**
     * @return void
     */
    private function closeConnection()
    {
        if (is_resource($this->getCurl())) {
            curl_close($this->getCurl());
        }

        $this->setCurl(null);
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->closeConnection();
    }

    /**
     * @param $optionName
     * @param $optionValue
     *
     * @return bool
     */
    protected function setCurlOption($optionName, $optionValue)
    {
        return curl_setopt($this->curl, $optionName, $optionValue);
    }

    /**
     * @throws CurlException
     */
    protected function setDefaultOptions()
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_ENCODING       => 'gzip,deflate',
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 30,
        ];

        if (!curl_setopt_array($this->getCurl(), $options)) {
            throw new CurlException(curl_error($this->getCurl()), curl_errno($this->getCurl()));
        }
    }

    /**
     * @param int $seconds
     */
    public function setTimeout($seconds)
    {
        $this->setCurlOption(CURLOPT_TIMEOUT, $seconds);
    }

    /**
     * @param integer $seconds
     */
    public function setConnectTimeOut($seconds)
    {
        $this->setCurlOption(CURLOPT_CONNECTTIMEOUT, $seconds);
    }

    /**
     * @param array $headers
     * @return void
     */
    protected function setHeaders($headers = [])
    {
        $headersArray = [];
        if (empty($headers)) {
            $headersArray = $this->defaultHeaders;
        }

        $headersArray['Authorization'] = 'Bearer ' . $this->getBearerToken();

        $headersArray = array_merge($headersArray, $headers);

        $this->setCurlOption(CURLOPT_HTTPHEADER, $headersArray);
    }

    /**
     * Sets default headers and options
     * @throws CurlException
     */
    protected function setDefaults()
    {
        $this->setDefaultOptions();
    }

    /**
     * @param string $method
     */
    protected function setRequestMethod($method)
    {
        $this->setCurlOption(CURLOPT_HTTPGET, false);
        $this->setCurlOption(CURLOPT_POST, false);
        $this->setCurlOption(CURLOPT_CUSTOMREQUEST, '');

        switch (strtoupper($method)) {
            case 'GET':
                $this->setCurlOption(CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                $this->setCurlOption(CURLOPT_POST, true);
                break;
            default:
                $this->setCurlOption(CURLOPT_CUSTOMREQUEST, $method);
        }
    }

    /**
     * @param string $method
     * @param array $params
     * @return string
     */
    private function setParamsRequest($method = 'GET', $params = [])
    {
        if ($method === 'GET') {
            $url = $this->getUrl();

            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
                $this->setUrl($url);
            }

            return;
        }

        $this->setCurlOption(CURLOPT_POSTFIELDS, http_build_query($params));
    }

    /**
     * @return void
     */
    private function makeCurlRequest()
    {
        $this->setResponse(curl_exec($this->getCurl()));
    }


    /**
     * @param string $url
     * @param array $requestParams
     * @param array $headers
     * @return string
     * @throws CurlException
     */
    public function get($url, $requestParams = null, $headers = [])
    {
        return $this->request($url, 'GET', $requestParams, $headers);
    }

    /**
     * @param string $url
     * @param array $requestParams
     * @param array $headers
     * @return string
     * @throws CurlException
     */
    public function post($url, $requestParams = null, $headers = [])
    {
        return $this->request($url, 'POST', $requestParams, $headers);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $params
     * @param array $headers
     * @throws CurlException
     * @return string
     */
    public function request($url, $method = 'GET', $params = [], $headers = [])
    {
        $this->setURL($url);
        $this->setRequestMethod($method);
        $this->setParamsRequest($method, $params);
        $this->setHeaders($headers);
        $this->setCurlOption(CURLOPT_URL, $this->getUrl());

        $this->makeCurlRequest();

        if ($this->getResponse() === false) {
            throw new CurlException(curl_error($this->getCurl()), curl_errno($this->getCurl()));
        }

        if (curl_errno($this->getCurl())) {
            throw new CurlException(curl_error($this->getCurl()), curl_errno($this->getCurl()));
        }

        $this->closeConnection();

        return $this->getResponse();
    }
}