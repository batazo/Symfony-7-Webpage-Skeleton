<?php
namespace App\Helpers;

use Symfony\Component\HttpFoundation\Request;
class HelperFunctions
{
    public static function getTokenFromCookie(Request $request): string|null {
        return $request->cookies->get("token");
        
    }
}
