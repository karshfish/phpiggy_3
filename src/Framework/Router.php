<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    // Responsible for adding new routes.
    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }
    //Normalizing the route to insure stability
    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        return $path;
    }
    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);
        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['path']}$#", $path) ||
                $route['method'] !== $method
            ) {

                continue;
            }
            [$class, $function] = $route['controller'];
            if ($container) {
                $InstanceOflClass = $container->resolve($class);
            } else {
                $InstanceOflClass = new $class;
            }
            $InstanceOflClass->$function();
            exit();
        }
    }
}
