<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FlightControllerTest extends WebTestCase
{
    public function test_givenNoParameters_thenBadRequest(): void
    {
        $client = self::createClient();
        $client->request('GET', '/fetchArrivals');

        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function test_givenDocumentationData_thenCorrectRequest(): void
    {
        $client = self::createClient();
        $client->request('GET', '/fetchArrivals', [
            'airportCode' => 'EDDF',
            'startTime' => '1517227200',
            'endTime' => '1517230800',
        ]);
        self::assertResponseStatusCodeSame(Response::HTTP_OK);

    }

    public function test_givenDocumentationData_thenCorrectStructure(): void
    {
        $client = self::createClient();
        $client->request('GET', '/fetchArrivals', [
            'airportCode' => 'EDDF',
            'startTime' => '1517227200',
            'endTime' => '1517230800',
        ]);
        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        self::assertIsArray($content);
        self::assertGreaterThan(0, count($content));

        $firstElement = $content[0];

        self::assertObjectHasProperty('icao24', $firstElement);
        self::assertObjectHasProperty('firstSeen', $firstElement);
        self::assertObjectHasProperty('estDepartureAirport', $firstElement);
        self::assertObjectHasProperty('lastSeen', $firstElement);
        self::assertObjectHasProperty('estArrivalAirport', $firstElement);
        self::assertObjectHasProperty('callsign', $firstElement);
        self::assertObjectHasProperty('estDepartureAirportHorizDistance', $firstElement);
        self::assertObjectHasProperty('estDepartureAirportVertDistance', $firstElement);
        self::assertObjectHasProperty('estArrivalAirportHorizDistance', $firstElement);
        self::assertObjectHasProperty('estArrivalAirportVertDistance', $firstElement);
        self::assertObjectHasProperty('departureAirportCandidatesCount', $firstElement);
        self::assertObjectHasProperty('arrivalAirportCandidatesCount', $firstElement);
    }
}
