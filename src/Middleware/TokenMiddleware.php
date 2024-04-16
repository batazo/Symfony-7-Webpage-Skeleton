<?php


namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class TokenMiddleware implements HttpKernelInterface
{
    private $app;
    private $arg;

    public function __construct(HttpKernelInterface $app, $arg)
    {
        $this->app = $app;
        $this->arg = $arg;
    }

    public function handle(Request $request, int $type = self::MASTER_REQUEST, bool $catch = true): Response
    {  
        var_dump($this->arg);      
        $token = $request->cookies->get('token');
        $request->attributes->set('token', $token);

        return $this->app->handle($request, $type, $catch);
    }
}