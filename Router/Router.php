<?php

namespace Owlnext\NotificationAPI\Router;

use Owlnext\NotificationAPI\Exception\RouterException;
use ReflectionClass;

class Router
{

    private array $routes = [];

    public function __construct()
    {
        foreach ((new ReflectionClass(Routes::class))->getConstants() as $constName => $constValue) {
            $this->routes[strtolower($constName)] = $constValue;
        }
    }

    public function isAuthRoute(string $path): bool
    {
        return str_contains($path, "token");
    }

    public function isPublicRoute(string $path): bool
    {
        return str_contains($path, "/api/docs");
    }

    public function generate(string $path, array $params = []): string
    {
        foreach ($params as $paramName => $paramValue) {
            $path = str_replace(sprintf("{%s}", $paramName), $paramValue, $path);
        }

        if (true === str_contains($path, '{')) {
            $startPos = strpos($path, '{');
            $endPos = strpos($path, '}');

            $missingVariable = substr($path, $startPos, ($endPos - $startPos));

            throw new RouterException(sprintf("Missing variable %s in path %s", $missingVariable, $path));
        }

        return $path;
    }

    public function generateByName(string $routeName, array $params = []): string
    {
        if (false === array_key_exists($routeName, $this->routes)) {
            throw new RouterException("Route not found: %s", $routeName);
        }

        return $this->generate($this->routes[$routeName], $params);
    }

}