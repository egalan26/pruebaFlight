<?php

namespace App\Listeners;

use InvalidArgumentException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [
                ['processException'],
            ]
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = match(get_class($exception)){
            InvalidArgumentException::class => new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST),
            default => new JsonResponse('Error Inesperado', Response::HTTP_INTERNAL_SERVER_ERROR)

        };
        $event->setResponse($response);
    }
}