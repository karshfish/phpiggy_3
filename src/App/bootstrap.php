<?php

declare(strict_types=1);
require __DIR__ . "/../../vendor/autoload.php";

use Framework\App; //importing Framework
use App\Controllers\HomeController; //importing HomeController
$app = new App();
$app->get('/', [HomeController::class, 'home']); //Intializing  index page
$app->get('/about', [HomeController::class, 'about']); //intializing about page
// dd($app);

return $app;
