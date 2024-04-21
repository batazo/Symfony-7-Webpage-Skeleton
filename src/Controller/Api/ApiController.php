<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController  extends AbstractController
{
    #[Route('/', "Api-home")]
    public function defaultApiAction(): JsonResponse
    {
        (array)$data = ['message'=>'API ROUTE'];

        return new JsonResponse($data);   
    }

    #[Route('/teszt', "Api-teszt")]
    public function tesztApiAction(): JsonResponse
    {
        (array)$data = ['message'=>'OK API'];

        return new JsonResponse($data);
    }

}