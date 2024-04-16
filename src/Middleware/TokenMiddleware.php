<?php


namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class NumberMiddleware implements HttpKernelInterface
{
    private $app;

    public function __construct(HttpKernelInterface $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        if ($request->attributes->get('_route') === 'teszt-render') {
            $request->attributes->set('number', 5);
        }

        return $this->app->handle($request, $type, $catch);
    }
}