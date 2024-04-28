<?php

namespace App\Controller;

use App\Exceptions\AirportNotFoundException;
use App\UseCases\FetchArrivalByAirportUseCase;
use FOS\RestBundle\Controller\Annotations\Route;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FlightController extends ApiAbstractController
{
    /**
     * @throws GuzzleException
     */
    #[Route("/fetchArrivals")]
    public function fetchEveryArrival(
        Request                      $request,
        FetchArrivalByAirportUseCase $arrivalByAirportUseCase
    ): JsonResponse
    {
        $airportCode = $request->query->get('airportCode');
        $startTime = $request->query->get('startTime');
        $endTime = $request->query->get('endTime');

        try {
            $result = $arrivalByAirportUseCase($airportCode, $startTime, $endTime);
        } catch (AirportNotFoundException $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }catch (\TypeError $exception){
            return new JsonResponse('Los parámetros de entrada son incorrectos.', Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse($result);
    }


}