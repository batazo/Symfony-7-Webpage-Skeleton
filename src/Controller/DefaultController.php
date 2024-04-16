<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    #[Route('/')]
    public function defaultAction(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Hello: '.$number.'</body></html>'
        );
    }
}