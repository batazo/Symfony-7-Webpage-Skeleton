<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\Request;

class BeforeTesztRenderListener
{
    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller) && $controller[1] === 'tesztRenderAction') {
            /** @var Request $request */
            $request = $event->getRequest();
            $request->attributes->set('number', 5);
        }
    }
}