<?php

namespace Core;

class Container
{
    public static function newController(string $controller)
    {
        $controller = "App\\Controllers\\{$controller}";
        return new $controller;
    }

    public static function routeNotFound()
    {
        return require_once __DIR__ . "/../app/Views/404NotFound.php";
    }
}
