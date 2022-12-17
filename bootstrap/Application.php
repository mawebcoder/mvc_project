<?php

namespace bootstrap;

use App\Models\Model;
use Dotenv\Dotenv;

class Application
{

    public function __construct()
    {
        $this->registerRoutes();

        $this->registerDotEnv();
    }

    public function registerRoutes(): Route
    {
        require_once __DIR__ . '/Route.php';

        return new Route();
    }

    public function registerDotEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__."/..");

        $dotenv->load();
    }
}