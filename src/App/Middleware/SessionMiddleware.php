<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionExceptions;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionExceptions("Session already active.");
        }
        if (headers_sent()) {
            throw new SessionExceptions("Headersalready sent");
        }
        session_start();
        $next();
    }
}
