<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;
            $excludedFormData = ['pwd', 'conf_pwd'];
            $formattedFormData = array_diff_key(
                $oldFormData,
                array_flip($excludedFormData)
            );
            $_SESSION['errors'] = $e->errors; //storing the errors of the exception in thus variable
            $_SESSION['oldFormdata'] = $_POST;
            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}
