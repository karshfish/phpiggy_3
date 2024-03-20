<?php

declare(strict_types=1);
require __DIR__ . "/../../vendor/autoload.php";

use Framework\App; //importing Framework
use function App\Config\registerRoutes;
use App\Config\Paths as PATH;

$app = new App(PATH::SOURCE . "App/container-definitions.php");
registerRoutes($app); // autoloading function for routes to avoid cluttering 
// dd($app);

return $app;
