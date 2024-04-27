<?php

namespace App\UseCases;

use App\Exceptions\AirportNotFoundException;
use App\Service\OpenskyExternalApiService;
use GuzzleHttp\Exception\GuzzleException;

class FetchArrivalByAirportUseCase
{
    public function __construct(
        private readonly OpenskyExternalApiService $openskyExternalApiService
    )
    {
    }

    /**
     * @throws GuzzleException
     * @throws AirportNotFoundException
     */
    public function __invoke($airport, $from, $to)
    {
        return $this->openskyExternalApiService->getArrivals($airport, $from, $to);

    }
}