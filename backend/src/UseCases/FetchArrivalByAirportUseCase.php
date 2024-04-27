<?php

namespace App\UseCases;

use App\Service\OpenskyExternalApiService;

class FetchArrivalByAirportUseCase
{
    public function __construct(
        private readonly OpenskyExternalApiService $openskyExternalApiService
    )
    {
    }

    public function __invoke($airport,$from,$to)
    {
        return $this->openskyExternalApiService->getArrivals($airport, $from, $to);

    }
}