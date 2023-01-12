<?php

namespace System;

class Response
{

    public function __construct(public readonly array $data, public int $statusCode = 200)
    {
    }

    public function __toString(): string
    {
        header('Content-Type:application/json');

        http_response_code($this->statusCode);

        return json_encode($this->data, true);
    }
}