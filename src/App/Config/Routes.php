<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AboutController, AuthController, LoginController}; //importing HomeController
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->addRouteMiddleware(AuthRequiredMiddleware::class); //Intializing  index page
    $app->get('/about', [AboutController::class, 'about']); //intializing about page
    $app->get('/register', [AuthController::class, 'registrationView'])->addRouteMiddleware(GuestOnlyMiddleware::class); //intializing registration page
    $app->post('/register', [AuthController::class, 'register'])->addRouteMiddleware(GuestOnlyMiddleware::class);
    $app->get('/login', [LoginController::class, 'viewLogin'])->addRouteMiddleware(GuestOnlyMiddleware::class); //Viewing Login page
    $app->post('/login', [LoginController::class, 'login'])->addRouteMiddleware(GuestOnlyMiddleware::class);
}
