<?php

use System\Routing;

class Application
{
    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->registerConfigs();

        $this->registerRouteService();
    }

    /**
     * @throws ReflectionException
     */
    private function registerRouteService(): void
    {
        $routing = new Routing();

        $routing->run();
    }

    private function registerConfigs(): void
    {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . '/../config/*.php');

        foreach ($files as $file) {
            require_once $file;
        }
    }
}

return new Application();