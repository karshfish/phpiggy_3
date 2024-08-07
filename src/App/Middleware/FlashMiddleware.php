<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine as TE;

class  FlashMiddleware implements MiddlewareInterface
{
    public function __construct(private TE $view)
    {
    }
    public function process(callable $next)
    {
        $this->view->addGlobal('errors', $_SESSION['errors'] ?? []);
        unset($_SESSION['errors']);

        $this->view->addGlobal('oldFormdata', $_SESSION['oldFormdata'] ?? []);

        unset($_SESSION['oldFormdata']);
        $next();
    }
}
