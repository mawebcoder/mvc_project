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
        $configFileAddress = __DIR__ . "/../config/" . $configFileName . '.php';

        if (!file_exists($configFileAddress)) {
            return  null;
        }

        return require_once $configFileAddress;
    }
}
