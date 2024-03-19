<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AboutController}; //importing HomeController

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home']); //Intializing  index page
    $app->get('/about', [AboutController::class, 'about']); //intializing about page
}
