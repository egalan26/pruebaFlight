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

    public function __invoke()
    {
        return $this->openskyExternalApiService->getArrivals('EDDF', '1517227200', '1517230800');

    }
}