<?php

namespace System;

class Request
{

    public static function post(string $key = null)
    {
        $jsonInputData = json_decode(file_get_contents('php://input'), true);

        $formData = $_POST;

        $result = [];

        if (!is_null($jsonInputData)) {
            $result = array_merge($result, $jsonInputData);
        }

        $result = array_merge($result, $formData);

        if ($key) {
            return $result[$key] ?? null;
        }

        return $result;
    }

    public static function get(string $key = null)
    {
        $data = $_GET;

        if ($key) {
            return $data[$key] ?? null;
        }

        return $data;
    }

    public static function hasKey(string $key): bool
    {
        return !is_null(self::get($key)) || !is_null(self::post($key));
    }

}