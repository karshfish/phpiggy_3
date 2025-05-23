<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class CsrfGuardMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $validRequests = ['POST', 'PATCH', 'DELETE'];
        if (!in_array($requestMethod, $validRequests)) {
            $next();
            return; //This is an important step bcs we need the method to continue  working early to prevent additional outside code from running
        }
        if ($_SESSION['token'] !== $_POST['token']) {
            redirectTo('/'); //TO DO is to do a custom exception for the csrf token
        }
        unset($_SESSION['token']); //Preventing an attacker to use the same token more than one time 
        $next();
    }
}
