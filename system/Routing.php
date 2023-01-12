<?php

namespace System;

use ReflectionClass;
use System\Route;
use ReflectionException;
use ReflectionMethod;
use Exception;

class Routing
{
    private string $requestedRoute;
    private array $definedRoutes;
    private string $requestedHttpVerb;
    private array $parameters = [];
    private int $requiredParameters = 0;

    public array $values;

    private const HTTP_VERB_GET = 'get';
    private const HTTP_VERB_POST = 'post';
    private const HTTP_VERB_PUT = 'put';
    private const HTTP_VERB_DELETE = 'delete';
    private const HTTP_VERB_PATCH = 'patch';

    public function __set(string $name, $value): void
    {
        $this->values[$name] = $value;
    }

    public function __get(string $name)
    {
        return $this->values[$name];
    }

    public function __construct()
    {
        $this->requestedRoute = $this->getRequestedRoute();

        $this->definedRoutes = $this->getRoutes();

        $this->requestedHttpVerb = $this->getRequestedHttpVerb();

        $this->parameters = $this->getRequestedRouteParameters();
    }

    private function getRequestedRoute(): string
    {
        return trim(trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'));
    }

    private function getRoutes(): array
    {
        return Route::$routes;
    }

    private function getRequestedHttpVerb(): string
    {
        $httpVerb = strtolower($_SERVER['REQUEST_METHOD']);

        if ($httpVerb === self::HTTP_VERB_GET) {
            return $httpVerb;
        }

        if (!isset($_POST['_method'])) {
            return self::HTTP_VERB_POST;
        }

        return match (strtolower($_POST['_method'])) {
            self::HTTP_VERB_PUT => self::HTTP_VERB_PUT,
            self::HTTP_VERB_DELETE => self::HTTP_VERB_DELETE,
            default => self::HTTP_VERB_PATCH
        };
    }

    private function getRequestedRouteParameters(): array
    {
        return [];
    }

    public function error404()
    {
        http_response_code(404);

        require_once __DIR__ . '/../resources/views/errors/404.php';

        exit();
    }


    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function run(): void
    {
        $requestedHttpVerb = $this->requestedHttpVerb;

        $routes = $this->getRoutes()[$this->requestedHttpVerb];


        foreach ($routes as $route) {
            $reservedRoute = $route['uri'];
            if ($this->isRequestedRouteExistsInReservedRoute($reservedRoute)) {
                if (!class_exists($route['controller'])) {
                    throw new Exception('controller not found');
                }
                $controllerObject = (new ReflectionClass($route['controller']))->newInstance();
                $method = $route['method'];

                if (!method_exists($controllerObject, $method)) {
                    throw new Exception('method not found');
                }

                $reflectionMethod = new ReflectionMethod($controllerObject, $method);

                $methodRequiredParameters = $reflectionMethod->getNumberOfRequiredParameters();

                if ($methodRequiredParameters > $this->parameters) {
                    throw new Exception('required parameters not defined');
                }

                if ($methodRequiredParameters < $this->requiredParameters) {
                    throw new Exception('the required parameters of the action and route are not same!');
                }


                $result = call_user_func_array([$controllerObject, $method], $this->parameters);

                if (gettype($result) === 'object') {
                    echo $result;
                    die();
                }

                if (gettype($result) === 'array') {
                    echo new Response($result);
                    die();
                }
                if (gettype($result) == 'integer' || gettype($result) == 'string' || gettype($result) == 'boolean') {
                    echo $result;
                }

                return;
            }
        }

        $this->error404();
    }


    public function isRequestedRouteExistsInReservedRoute(string $reservedRoute): bool
    {
        $this->parameters = [];

        $reservedRoute = trim(trim($reservedRoute, '/'));
        /**
         * user requested the home page
         */
        if (empty($reservedRoute) && empty($this->requestedRoute)) {
            return true;
        }

        if (empty(trim(trim($reservedRoute, '/')))) {
            return false;
        }

        $explodedRequestedRoute = explode('/', $this->requestedRoute);
        $explodedReservedRoute = explode('/', $reservedRoute);

        if (count($explodedRequestedRoute) !== count($explodedReservedRoute)) {
            return false;
        }

        foreach ($explodedRequestedRoute as $index => $value) {
            $sameIndexValueInReservedRoute = $explodedReservedRoute[$index];

            /**
             * is required parameter
             */
            if (preg_match('/^[{].+[^?]}$/', $sameIndexValueInReservedRoute)) {
                $this->parameters[] = $value;
                $this->requiredParameters += 1;
                continue;
            } elseif (preg_match('/^[{].+}$/', $sameIndexValueInReservedRoute)) {
                $this->parameters[] = $value;
                continue;
            }


            if ($sameIndexValueInReservedRoute !== $value) {
                return false;
            }
        }

        return true;
    }
}