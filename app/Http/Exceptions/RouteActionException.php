<?php

namespace App\Http\Exceptions;

use Exception;

class RouteActionException extends Exception
{
    protected $message = 'action not defined';

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {

    }

}