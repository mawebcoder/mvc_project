<?php

namespace System;

class Route
{

    public static array $routes = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete' => []
    ];

    public static function get(string $uri, array $action, string $routeName = null): void
    {
        self::$routes[]['get'] = [
            'name' => $routeName,
            'controller' => $action[0],
            'method' => $action[1],
            "uri" => trim($uri, '/')
        ];
    }

    public static function post(string $uri, array $action, string $routeName = null): void
    {
        self::$routes[]['post'] = [
            'name' => $routeName,
            'controller' => $action[0],
            'method' => $action[1],
            "uri" => trim($uri, '/')
        ];
    }

    public static function put(string $uri, array $action, string $routeName = null): void
    {
        self::$routes[]['put'] = [
            'name' => $routeName,
            'controller' => $action[0],
            'method' => $action[1],
            "uri" => trim($uri, '/')
        ];
    }

    public static function delete(string $uri, array $action, string $routeName = null): void
    {
        self::$routes[]['delete'] = [
            'name' => $routeName,
            'controller' => $action[0],
            'method' => $action[1],
            "uri" => trim($uri, '/')
        ];
    }


}