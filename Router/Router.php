<?php

namespace Owlnext\NotificationAPI\Router;

class Router
{
    public static function isAuthRoute(string $path): bool {
        return str_contains($path, "token");
    }

    public static function isPublicRoute(string $path): bool {
        return str_contains($path, "/api/docs");
    }

    public static function generate(string $path, array $params): string {
        foreach ($params as $paramName => $paramValue) {
            $path = str_replace(sprintf("{%s}", $paramName), $paramValue, $path);
        }

        // TODO GEGER LA PUTAIN DEXCEPTION PD

        return $path;
    }
}