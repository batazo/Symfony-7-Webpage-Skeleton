<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Helpers\HelperFunctions;

class DefaultController  extends AbstractController
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
        $data = HelperFunctions::getTokenFromCookie($request);

        return new JsonResponse($data);
    }

    #[Route('/tesztRender', "teszt-render")]
    public function tesztRenderAction(Request $request): Response
    {
        $env_var = $_ENV['TESZT_ENV'];
        $number = $request->attributes->get('number');
        $token = $request->attributes->get('token');
        $staticParam = $this->getParameter('staticparam');
        $serviceParam = $this->getParameter('serviceparameter');

        return $this->render('tesztrender.html.twig', [
            'welcome'=>'Hello on my awesome website',
            'some_variable' => $number,
            'token'=>$token,
            'static_param'=>$staticParam,
            'service_param'=>$serviceParam,
            'env_var'=>$env_var
        ]);
    }

}