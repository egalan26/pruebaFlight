<?php

namespace App\Controller;

use App\Exceptions\AirportNotFoundException;
use App\UseCases\FetchArrivalByAirportUseCase;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FlightController extends ApiAbstractController
{
    /**
     * @throws GuzzleException
     */
    public function fetchEveryArrival(
        Request $request,
        FetchArrivalByAirportUseCase $arrivalByAirportUseCase
    ): JsonResponse
    {
        $airportCode = $this->extractFromQuery($request, 'airportCode');
        try {
            $result = $arrivalByAirportUseCase($airportCode, '1517227200', '1517230800');
        }catch (AirportNotFoundException $exception){
            return new JsonResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }


        return new JsonResponse($result);
    }

}