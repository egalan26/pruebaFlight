<?php

namespace App\Service;

use App\Exceptions\AirportNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenskyExternalApiService
{

    /**
     * @throws GuzzleException
     * @throws AirportNotFoundException
     */
    public function getArrivals(
        string $airport,
        int    $from,
        int    $to
    )
    {
        try {
            $str = "/api/flights/arrival?airport=$airport&begin=$from&end=$to";
            $response = $this->getClient()->get($str);
        } catch (\Exception) {
            throw new AirportNotFoundException("El aeropuerto $airport no está disponible en OpenSky");
        }
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