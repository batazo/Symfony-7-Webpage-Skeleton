<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\Request;

class BeforeTesztRenderListener
{
    private $evl_arg;
    public function __construct($evl_arg)
    {
        $this->evl_arg = $evl_arg;
    }
    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller) && $controller[1] === 'tesztRenderAction') {
            /** @var Request $request */
            $request = $event->getRequest();
            $request->attributes->set('number', 5);
            $token = $request->cookies->get('token');
            $request->attributes->set('token', $token);
            $request->attributes->set('arg', $this->evl_arg);
        }
    }
}