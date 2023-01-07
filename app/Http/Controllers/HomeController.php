<?php

namespace APP\Http\Controllers;

class HomeController
{

    public function name()
    {
        echo "name controller in HomeController";
    }

    public function index()
    {
        redirect('https://digikala.com');
    }
}