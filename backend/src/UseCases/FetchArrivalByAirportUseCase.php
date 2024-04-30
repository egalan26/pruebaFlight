<?php

namespace App\UseCases;

use App\Service\OpenskyExternalApiService;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class FetchArrivalByAirportUseCase
{
    public function __construct(
        private readonly OpenskyExternalApiService $openskyExternalApiService
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __invoke($airport, $from, $to)
    {
        $cache = new FilesystemAdapter();
        return $cache->get("Flight$airport-$from-$to", function (ItemInterface $item) use ($airport, $from, $to){
            $item->expiresAfter(60); // 1 min
            return $this->openskyExternalApiService->getArrivals($airport, $from, $to);
        });

    }
}