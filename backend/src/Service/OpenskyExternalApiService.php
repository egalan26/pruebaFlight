<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenskyExternalApiService
{

    /**
     * @throws GuzzleException
     */
    public function getArrivals(
        string $airport,
        int    $from,
        int    $to
    )
    {
        $response = $this->getClient()->get(
            "/api/flights/arrival?airport=$airport&begin=$from&end=$to"
        );
        return json_decode($response->getBody()->getContents());

    }

    public function getClient(): Client
    {
        $client = new Client([
            'base_uri' => 'https://opensky-network.org'
        ]);
        return $client;
    }
}