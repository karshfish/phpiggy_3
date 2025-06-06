<?php

declare(strict_types=1);

namespace Framework;

// use App\Middleware\TemplateDataMiddleware;

class Router
{
    private array $routes = [];
    private array $Middlewares = [];
    private array $errorHandlers = [];
    // Responsible for adding new routes.
    public function add(string $method, string $path, array $controller)
    {

        $path = $this->normalizePath($path);
        $regexPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller,
            'middleware' => [],
            'regexPath' => $regexPath
        ];
    }
    //Normalizing the route to insure stability
    private function normalizePath(string $path): string //using regular expression to normalize all paths
    {
        $path = trim($path, '/'); //removing all repeated "/" from the path
        $path = "/{$path}/"; // making sure that the starts and ends with "/"s
        $path = preg_replace('#[/]{2,}#', '/', $path); //using this expression to remove all repeated "/"
        return $path;
    }
    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($_POST['_METHOD'] ?? $method);
        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['regexPath']}$#", $path, $paramValues) ||
                $route['method'] !== $method
            ) {

                continue;
            }
            array_shift($paramValues);
            preg_match_all('#{([^/]+)}#', $route['path'], $paramKeys);
            $paramKeys = $paramKeys[1];
            $params = array_combine($paramKeys, $paramValues);
            [$class, $function] = $route['controller'];
            if ($container) {
                $InstanceOflClass = $container->resolve($class);
            } else {
                $InstanceOflClass = new $class;
            }
            $action = fn() => $InstanceOflClass->$function($params);
            $allMiddleware = [...$route['middleware'], ...$this->Middlewares];
            foreach ($allMiddleware as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) :
                    new $middleware;
                $action = fn() => $middlewareInstance->process($action);
            }
            $action();
            return;
        }
        $this->dispatchNotFound($container);
    }
    public function addMiddleware(string $middleware)
    {
        $this->Middlewares[] = $middleware;
    }
    public function addRouteMiddleware(string $middleware)
    {
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middleware'][] = $middleware;
    }
    public function addErrorHandler(array $controller)
    {
        $this->errorHandlers[] = $controller;
    }
    public function dispatchNotFound(?Container $container)
    {
        [$class, $function] = $this->errorHandlers[0];
        $controllerInstancec = $container ? $container->resolve($class) : new $class;
        $action = fn() => $controllerInstancec->$function();
        foreach ($this->Middlewares as $middleware) {
            $middlewareInstance = $container ? $container->resolve($middleware) :
                new $middleware;
            $action = fn() => $middlewareInstance->process($action);
        }
        $action();
    }
}
