<?php

namespace App\Components;

use GuzzleHttp\Client;

class ImportStaffData
{
    public $client;

    /**
     * @param $client
     */
    public function __construct()
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://kinopoiskapiunofficial.tech/api/v1/',
            // You can set any number of default request options.
            'timeout'  => 5.0,
            'verify' => false,
        ]);
    }
}
