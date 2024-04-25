<?php

namespace App\Controller;

use App\UseCases\FetchArrivalByAirportUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class FlightController extends AbstractController
{
    public function a(FetchArrivalByAirportUseCase $arrivalByAirportUseCase)
    {

        $result = $arrivalByAirportUseCase();

        return new JsonResponse($result);
    }

}