<?php

namespace System;

class Routing
{
    private string $requestedRoute;
    private array $definedRoutes;
    private string $requestedHttpVerb;
    private array $parameters = [];

    public array $values;

    public function __set(string $name, $value): void
    {
        $this->values[$name]=$value;
    }

    public function __get(string $name)
    {
        return $this->values[$name];
    }

    public function __construct()
    {
        $this->requestedRoute = $this->gerRequestedRoute();

        $this->definedRoutes = $this->getRoutes();

        $this->requestedHttpVerb = $this->getRequestedHttpVerb();

        $this->parameters = $this->getRequestedRouteParameters();
    }

    private function gerRequestedRoute():string
    {
        return 'string';
    }

    private function getRoutes():array
    {
        return Route::$routes;
    }

    private function getRequestedHttpVerb():string
    {
        return 'GET';
    }

    private function getRequestedRouteParameters():array
    {
        return [];
    }
}