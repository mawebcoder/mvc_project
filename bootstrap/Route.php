<?php

namespace bootstrap;

use Exception;
use ReflectionClass;
use ReflectionMethod;

class Route
{
    public string|null $current_route;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->takeAction();
    }

    public function getUri(): string
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }

    /**
     * @throws Exception
     */
    public function takeAction(): void
    {
        $controller = $this->getController();

        if (!file_exists(__DIR__ . "/../app/Http/Controllers/" . $controller . '.php')) {
            throw  new Exception('controller does not exist');
        }

        $controllerNamespace = "\\App\Http\\Controllers\\" . $controller;

        $reflectionClass = new ReflectionClass($controllerNamespace);

        $controllerObject = $reflectionClass->newInstance();

        $method = $this->getMethod();

        if (!method_exists($controllerObject, $method)) {
            throw new Exception('method not found in controller');
        }

        $parameters = $this->getParameters();

        $reflectionMethod = new ReflectionMethod($controllerObject, $method);

        if ($reflectionMethod->getNumberOfRequiredParameters() !== count($parameters)) {
            throw new Exception('page not found');
        }

        call_user_func_array([$controllerObject, $method], $parameters);
    }

    public function getController(): string
    {
        $uri = trim($this->getUri(), '/');

        $explodedUri = explode('/', $uri);

        return !empty($explodedUri[0]) ? $explodedUri[0] : "HomeController";
    }

    public function getMethod(): string
    {
        $uri = trim($this->getUri(), '/');

        $explodedUri = explode('/', $uri);

        return isset($explodedUri[1]) && !empty($explodedUri[1]) ? $explodedUri[1] : "index";
    }

    public function getParameters(): array
    {
        $uri = trim($this->getUri(), '/');

        $explodedUri = explode('/', $uri);

        if (!isset($explodedUri[1])) {
            return [];
        }

        array_splice($explodedUri, 0, 2);

        return array_values($explodedUri);
    }
}