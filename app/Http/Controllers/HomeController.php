<?php

namespace APP\Http\Controllers;

use Exception;

class HomeController
{

    public function name()
    {
        echo "name controller in HomeController";
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $name = 'javad';

        view('welcome', compact('name'));
    }
}