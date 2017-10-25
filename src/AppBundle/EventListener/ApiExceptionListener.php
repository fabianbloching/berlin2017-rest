<?php

namespace AppBundle\EventListener;

use AppBundle\Exception\ApiException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiExceptionListener implements EventSubscriberInterface
{
    const API_PATH = '/api/';

    public function handleNotFoundException(GetResponseForExceptionEvent $e)
    {
        if (!$this->isApi($e)) {
            return;
        }

        if (!$e->getException() instanceof NotFoundHttpException) {
            return;
        }

        $e->setResponse(
            new JsonResponse(
                ['error' => 'Not Found'],
                Response::HTTP_NOT_FOUND
            )
        );
    }

    public function handleApiException(GetResponseForExceptionEvent $e)
    {
        if (!$this->isApi($e)) {
            return;
        }

        if (!$e->getException() instanceof ApiException) {
            return;
        }

        $e->setResponse(
            new JsonResponse(
                [
                    'error' => 'API Error',
                    'message' => $e->getException()->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            )
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [
                ['handleNotFoundException'],
                ['handleApiException']
            ]
        ];
    }

    private function isApi(GetResponseForExceptionEvent $e)
    {
        return stripos($e->getRequest()->getPathInfo(), self::API_PATH) === 0;
    }
}
