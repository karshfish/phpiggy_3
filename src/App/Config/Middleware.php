<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{TemplateDataMiddleware, ValidationExceptionMiddleware};

function registerMiddleware(App $app)
{
    $app->addMiddleware(TemplateDataMiddleware::class); //Addin the first Middleware
    $app->addMiddleware(ValidationExceptionMiddleware::class);
}
