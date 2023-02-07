<?php

namespace TheNativeDeveloper\RapidWire;

use Closure;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use TheNativeDeveloper\RapidWire\Exceptions\CallbackException;
use TheNativeDeveloper\RapidWire\Exceptions\NoTypeException;
use TheNativeDeveloper\RapidWire\Exceptions\UnresolvableException;

class RapidWire implements ContainerInterface
{
    protected array $unresolvedClasses = [];
    protected array $resolvedClasses = [];

    public function register(string $class, Closure $callback): void
    {
        if (!$this->has($class)) {
            $this->unresolvedClasses[$class] = $callback;
        }
    }

    public function get(string $class)
    {
        if (isset($this->resolvedClasses[$class])) {
            return $this->resolvedClasses[$class];
        }

        if (isset($this->unresolvedClasses[$class])) {
            $object = $this->unresolvedClasses[$class];
            if (!is_object($object)) {
                throw new CallbackException('Callback to resolve class do not return an object.');
            }
            $this->resolvedClasses[$class] = $object;
        }

        if (!class_exists($class)) {
            throw new UnresolvableException(
                sprintf('Only classes are auto resolvable. Please register %s manualy.', $class)
            );
        }
        $resolvedClass = $this->autoResolveClass($class);

        $this->resolvedClasses[$class] = $resolvedClass;
        return $resolvedClass;
    }

    public function has(string $class): bool
    {
        return isset($this->unresolvedClasses[$class]) || isset($this->resolvedClasses[$class]);
    }

    protected function autoResolveClass(string $class)
    {
        $reflection = new ReflectionClass($class);
        $args = $this->resolveParameters($reflection);

        if (count($args) > 0) {
            return $reflection->newInstanceArgs($args);
        }

        return new $class();
    }

    protected function resolveParameters(ReflectionClass $reflection): array
    {
        $parameters = $reflection->getConstructor()?->getParameters() ?? [];
        $args = [];
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if ($type === null) {
                throw new NoTypeException(
                    sprintf(
                        'Constructor parameter %s of class %s has no type hint.',
                        $name,
                        $reflection->getName()
                    )
                );
            }
            if (class_exists($type) || interface_exists($type)) {
                $resolvedType = $this->get($type);
                $args[$name] = $resolvedType;
                continue;
            }

            if (!$parameter->isDefaultValueAvailable()) {
                throw new UnresolvableException(
                    'Cannot resolve parameter %s of constructor of %s.', $name, $class
                );
            }
        }

        return $args;
    }

    public function make($class, array $parameters)
    {
    }
}
