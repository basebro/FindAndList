<?php


namespace App\Services;

use GuzzleHttp\Client;

class GuzzleHttpClientService
{

    public function request($method, $url, $options)
    {
        $client = new Client();
        $response = $client->request($method, $url, $options);
        return $response->getBody()->getContents();
    }

}