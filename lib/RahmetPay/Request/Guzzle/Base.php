<?php

namespace RahmetPay\Request\Guzzle;

use Psr\Http\Message\ResponseInterface;

class Base extends Client
{
    /**
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function get($uri, $data = [], $headers = [])
    {
        $this->fetchResponseContents(
            parent::get($uri, [
                'headers' => $headers,
                'query' => $data
            ])
        );
    }

    /**
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function post($uri, $data = [], $headers = [])
    {
        return $this->fetchResponseContents(
            parent::post($uri, [
                'headers' => $headers,
                'form_params' => $data
            ])
        );
    }

    /**
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @return array
     */
    public function put($uri, $data = [], $headers = [])
    {
        return $this->fetchResponseContents(
            parent::put($uri, [
                'headers' => $headers,
                'form_params' => $data
            ])
        );
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function fetchResponseContents($response)
    {
        $contents = json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE);

        if (empty($contents)) {
            throw new \RuntimeException('Empty request contents');
        }

        return $contents;
    }
}
