<?php

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('getConfigFile')) {
    function getConfigFile(string $configFileName): array|null
    {
        $configFileAddress = $_SERVER['DOCUMENT_ROOT'] . "/../config/" . $configFileName . '.php';

        if (!file_exists($configFileAddress)) {
            return null;
        }


        return require $configFileAddress;
    }
}

if (!function_exists('redirect')) {
    function redirect(string $address): void
    {
        $address = trim($address);

        header("Location:" . $address);

        die();
    }
}

if (!function_exists('back')) {
    /**
     * @throws Exception
     */
    function back()
    {
        $http_referer = $_SERVER['HTTP_REFERER'] ?? null;

        if ($http_referer) {
            redirect($http_referer);
        }

        throw new Exception('route not found');
    }
}

if (!function_exists('view')) {
    /**
     * @throws Exception
     */
    function view(string $view, $data = []): void
    {
        $view = str_replace(".", '/', $view);

        $viewPath = $_SERVER['DOCUMENT_ROOT'] . "/../resource/view/" . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception('view not found');
        }

        if (count($data)) {
            extract($data);
        }

        require_once $viewPath;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return getConfigFile('app')['url'] . DIRECTORY_SEPARATOR . $path;
    }
}

if (!function_exists('extendView')) {
    /**
     * @throws Exception
     */
    function extendView(string $viewAddress, $data = [])
    {
        $view = str_replace(".", '/', $viewAddress);

        $viewPath = $_SERVER['DOCUMENT_ROOT'] . "/../resource/view/" . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception('view not found');
        }

        if (count($data)) {
            extract($data);
        }
        require_once $viewPath;
    }
}
