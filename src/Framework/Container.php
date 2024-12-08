<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exception\ContainerException as CE;
use Reflection;
use ReflectionClass, ReflectionNamedType;

class Container
{
    private array $definintions = [];
    private array $resolved = [];
    public function addDefinitions(array $newDefinitions)
    {
        $this->definintions = [...$this->definintions, ...$newDefinitions];
    }
    public function resolve(string $className) //to validate the class and creatt it
    {
        $reflectionClass = new ReflectionClass($className); //creating a reflection to know the class and see if it exists or not
        if (!$reflectionClass->isInstantiable()) { //to see if the class is instantiable or not
            throw new CE("Class {$className} is not instantiable");
        }
        $constructor = $reflectionClass->getConstructor(); //to get the constructor of the method and return as an object
        if (!$constructor) {
            return new $className;
        }
        $params = $constructor->getParameters(); //to know the necasserry parameters of the class by knowing the paramters in the constructor
        if (count($params) === 0) {
            return new $className;
        }
        $dependencies = []; //to store all the dependencies the needs to be instantiated
        foreach ($params as $param) { //Validating all dependencies
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) { //Forcing tpe hinting to aoid confusion
                throw new CE("Failed to resolve class {$className} because paramater {$name} is missing a type hint");
            }
            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) { //if the paramter in the constructor isn't a namedtyped we throw an error or if it is a builtin type
                throw new CE("Failed to resolve this class {$className} paramter {$name} is invalid");
            }
            $dependencies[] = $this->get($type->getName()); //Invoking the factory function for each dependancy 
        }
        return $reflectionClass->newInstanceArgs($dependencies); //Creating the instance of the object needed
    }
    public function get(string $id) //this function returns the instances of the definetions if exists and cheks that every instance is being create one time only
    {
        if (!array_key_exists($id, $this->definintions)) {
            throw new CE("Class not available");
        }
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }
        $factory = $this->definintions[$id];
        $dependency = $factory($this); /* @param $this allows the factory function to grab dependencies manually */
        $this->resolved[$id] = $dependency;
        return $dependency;
    }
}
