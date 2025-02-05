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
        if (headers_sent($filename, $line)) { //To make sure that a session can't be restarted without all data has been sent first
            throw new SessionExceptions("Headers already sent. Consider Enabling Output buffering data from {$filename} - Line {$line}");
        }
        session_set_cookie_params([
            'secure' => $_ENV['APP_ENV'] === 'production',
            'httponly' => true,
            'samesite' => 'lax'
        ]);
        session_start();
        $next();
        session_write_close();
    }
}
