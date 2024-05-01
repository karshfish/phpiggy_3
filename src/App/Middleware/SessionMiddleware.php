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
        if (headers_sent($filename, $line)) {
            throw new SessionExceptions("Headers already sent. Consider Enabling Output buffering data from {$filename} - Line {$line}");
        }
        session_start();
        $next();
        session_write_close();
    }
}
