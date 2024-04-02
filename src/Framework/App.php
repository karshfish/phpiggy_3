<?php

declare(strict_types=1);

namespace Framework;

class App
{

    private Router $router;
    private Container $container;

    public function __construct(string $containerDefinitionsPath = NULL) //Making the first thing to do when creating the App class is to search for the container definiions while making it optional 
    {
        $this->router = new Router();
        $this->container = new Container();
        if ($containerDefinitionsPath) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }
    public function run() //To run the rout if it exist
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch($path, $method, $this->container);
    }
    public function get(string $path, array $controller) //Adding a route to the routes list using get method
    {
        $this->router->add('GET', $path, $controller);
    }
    public function post(string $path, array $controller)
    {
        $this->router->add('POST', $path, $controller);
    }
    public function addMiddleware($middleware) //Adding a Middleware to the list 
    {
        $this->router->addMiddleware($middleware);
    }
}
