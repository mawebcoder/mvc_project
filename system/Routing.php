<?php



class Routing
{
    private string $requestedRoute;
    private array $definedRoutes;
    private string $requestedHttpVerb;
    private array $parameters = [];

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
        $this->requestedRoute = $this->gerRequestedRoute();

        $this->definedRoutes = $this->getRoutes();

        $this->requestedHttpVerb = $this->getRequestedHttpVerb();

        $this->parameters = $this->getRequestedRouteParameters();
    }

    private function gerRequestedRoute(): string
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
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

        require_once __DIR__.'/../resources/views/errors/404.php';
        exit();
    }
}