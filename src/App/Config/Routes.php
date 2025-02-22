<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AboutController, AuthController, LoginController, TransactionsController, ReceiptController, ErrorController}; //importing HomeController
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->addRouteMiddleware(AuthRequiredMiddleware::class); // index page
    $app->get('/about', [AboutController::class, 'about']); // about page
    $app->get('/register', [AuthController::class, 'registrationView'])->addRouteMiddleware(GuestOnlyMiddleware::class); // registration page
    $app->post('/register', [AuthController::class, 'register'])->addRouteMiddleware(GuestOnlyMiddleware::class);
    $app->get('/login', [LoginController::class, 'viewLogin'])->addRouteMiddleware(GuestOnlyMiddleware::class); //Viewing Login page
    $app->post('/login', [LoginController::class, 'login'])->addRouteMiddleware(GuestOnlyMiddleware::class);
    $app->get('/logout', [LoginController::class, 'logout'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->get('/createTransaction', [TransactionsController::class, 'createView'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->post('/createTransaction', [TransactionsController::class, 'createTransaction'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}', [TransactionsController::class, 'editTransactionView'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->post('/transaction/{transaction}', [TransactionsController::class, 'editTransaction'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->delete('/transaction/{transaction}', [TransactionsController::class, 'deleteTransaction'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}/receipt', [ReceiptController::class, 'uploadView'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->post('/transaction/{transaction}/receipt', [ReceiptController::class, 'upload'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'download'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->delete('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'delete'])->addRouteMiddleware(AuthRequiredMiddleware::class);
    $app->addErrorHandler([ErrorController::class, 'notFound']);
}
