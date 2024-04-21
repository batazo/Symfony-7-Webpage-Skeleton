<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{

    private $listener_type;
    public function __construct($listener_type)
    {
        $this->listener_type = $listener_type;
    }
    public function onKernelException(ExceptionEvent $event)
    {

        $exception = $event->getThrowable();        
        $request   = $event->getRequest();
        $path = $request->getPathInfo();
   

        if (strpos($path, "/api") !== false)
        {

            $response = new JsonResponse([
                'message'       => $exception->getMessage(),
                'code'          => $exception->getStatusCode(),
                'listener_type' => $this->listener_type
                //'traces'        => $exception->getTrace()
            ]);

            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $event->setResponse($response);
        }
    }
}