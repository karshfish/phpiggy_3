<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\TemplateEngine as TE;

use Framework\Contracts\MiddlewareInterface;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(private TE $views)
    {
        // var_dump($this->views);
    }
    public function process(callable $next) //this middleware dunction is responsible to add a tittle to any page
    {
        $this->views->addGlobal('title', 'Expense Tracking App');
        $next();
    }
}
