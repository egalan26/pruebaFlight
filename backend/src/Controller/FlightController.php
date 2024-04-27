<?php

namespace App\Controller;

use App\UseCases\FetchArrivalByAirportUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class FlightController extends AbstractController
{
    public function fetchEveryArrival(FetchArrivalByAirportUseCase $arrivalByAirportUseCase): JsonResponse
    {

        $result = $arrivalByAirportUseCase('EDDF', '1517227200', '1517230800');

        return new JsonResponse($result);
    }

}