<?php

namespace App\Controller;

use App\Dto\FlightParamsDto;
use App\UseCases\FetchArrivalByAirportUseCase;
use FOS\RestBundle\Controller\Annotations\Route;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class FlightController extends ApiAbstractController
{
    /**
     * @throws GuzzleException
     */
    #[Route("/fetchArrivals")]
    #[Security("is_authenticated()")]
    public function fetchEveryArrival(
        Request                      $request,
        ValidatorInterface           $validation,
        FetchArrivalByAirportUseCase $arrivalByAirportUseCase
    ): JsonResponse
    {
        $searchDto = new FlightParamsDto(...$this->extractParamsFromRequest($request));
        $errors = $validation->validate($searchDto);
        if (count($errors) > 0) {
            return new JsonResponse('Los parámetros de entrada son incorrectos.', Response::HTTP_BAD_REQUEST);
        }

        $result = $arrivalByAirportUseCase($searchDto->getAirport(), $searchDto->getStartTime(), $searchDto->getEndTime());


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