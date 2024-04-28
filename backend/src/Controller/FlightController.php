<?php

namespace App\Controller;

use App\Exceptions\AirportNotFoundException;
use App\UseCases\FetchArrivalByAirportUseCase;
use FOS\RestBundle\Controller\Annotations\Route;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class FlightController extends ApiAbstractController
{
    /**
     * @throws GuzzleException
     */
    #[Route("/fetchArrivals")]
    #[Security("is_authenticated()")]
    public function fetchEveryArrival(
        Request                      $request,
        FetchArrivalByAirportUseCase $arrivalByAirportUseCase
    ): JsonResponse
    {
        try {
            $result = $arrivalByAirportUseCase(...$this->extractParamsFromRequest($request));
        } catch (AirportNotFoundException $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }catch (\TypeError $exception){
            return new JsonResponse('Los parámetros de entrada son incorrectos.', Response::HTTP_BAD_REQUEST);
        }


        return new JsonResponse($result);
    }

    private function extractParamsFromRequest(Request $request): array
    {
        $airportCode = $request->query->get('airportCode');
        $startTime = $request->query->get('startTime');
        $endTime = $request->query->get('endTime');
        return [$airportCode, $startTime, $endTime];
    }


}