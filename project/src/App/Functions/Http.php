<?php

namespace App\Functions;

use GuzzleHttp\Client;

trait Http
{
    /***
     * @param $method
     * @param $url
     * @param $header
     * @param array $body
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    static function requestGuzzle($method, $url, $header, $body = array())
    {
        $clientGuzzle = new Client([
            'headers' => $header
        ]);

        return $clientGuzzle->request($method, $url, $body);
    }
}
