<?php

namespace APP\Http\Controllers;

class TestController
{

    public function index()
    {
        echo "index method in TestController";
    }

    public function name($id)
    {
        echo "name method in TestController-$id";
    }
}