<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exception\ContainerException as CE;
use Reflection;
use ReflectionClass, ReflectionNamedType;

class Container
{
    private array $definintions = [];
    public function addDefinitions(array $newDefinitions)
    {
        $this->definintions = [...$this->definintions, ...$newDefinitions];
    }
    public function resolve(string $className)
    {
        $reflectionClass = new ReflectionClass($className);
        if (!$reflectionClass->isInstantiable()) {
            throw new CE("Class {$className} is not instantiable");
        }
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $className;
        }
        $params = $constructor->getParameters();
        if (count($params) === 0) {
            return new $className;
        }
        $dependencies = [];
        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new CE("Failed to resolve class {$className} because paramater {$name} is missing a type hint");
            }
            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new CE("Failed to resolve this class {$className} paramter {$name} is invalid");
            }
            $dependencies[] = $this->get($type->getName());
        }
        return $reflectionClass->newInstanceArgs($dependencies);
    }
    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definintions)) {
            throw new CE("Class not available");
        }
        $factory = $this->definintions[$id];
        $dependency = $factory();
        return $dependency;
    }
}
