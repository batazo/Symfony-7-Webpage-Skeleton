<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    #[Route('/', "home")]
    public function defaultAction(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Hello: '.$number.'</body></html>'
        );
    }

    #[Route('/tesztJson', "teszt-json")]
    public function tesztJsonAction(): JsonResponse
    {
        (array)$data = ['message'=>'OK'];

        return new JsonResponse($data);
    }

    #[Route('/tesztHTML', "teszt-html")]
    public function tesztHtmlAction(): Response
    {
        return new Response(
            '<html><body>Hello</body></html>'
        );
    }
}