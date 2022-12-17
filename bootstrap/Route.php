<?php

namespace bootstrap;

class Route
{
    public string|null $current_route;

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getQueryParams()
    {

    }
}