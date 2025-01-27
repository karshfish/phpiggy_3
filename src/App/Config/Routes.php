<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AboutController, AuthController, LoginController}; //importing HomeController

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home']); //Intializing  index page
    $app->get('/about', [AboutController::class, 'about']); //intializing about page
    $app->get('/register', [AuthController::class, 'registrationView']); //intializing registration page
    $app->post('/register', [AuthController::class, 'register']);
    $app->get('/login', [LoginController::class, 'viewLogin']); //Viewing Login page
}
