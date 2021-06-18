<?php

namespace App\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait Http
{

    /***
     * @param $method
     * @param $url
     * @param $header
     * @param array $body
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    static function requestGuzzle($method, $url, $header, $body = array())
    {
        $client = new Client(['headers' => $header]);

        try {
            return $client->request($method, $url, $body);
        } catch (ClientException $e) {
            return $e;
        }
    }

}
