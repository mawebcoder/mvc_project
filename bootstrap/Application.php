<?php

namespace bootstrap;

use Dotenv\Dotenv;

class Application
{

    public function __construct()
    {
        $this->registerRoutes();
    }

    public function registerRoutes(): Route
    {
        require_once __DIR__ . '/Route.php';

        return new Route();
    }
}