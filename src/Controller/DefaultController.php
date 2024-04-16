<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/tesztReq/{path}', "teszt-req")]
    public function tesztRequestAction(Request $request, $path): JsonResponse
    {
        //?id=XY on route
        $data = $request->query->get("id");

        return new JsonResponse($path);
    }

    #[Route('/tesztCookie', "teszt-c")]
    public function tesztCookieAction(Request $request): JsonResponse
    {
        //cookies
        $data = $this->getTokenFromCookie($request);

        return new JsonResponse($data);
    }

    private function getTokenFromCookie(Request $request): string|null {
        return $request->cookies->get("token");
        
    }
}