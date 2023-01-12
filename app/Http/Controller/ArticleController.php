<?php

namespace App\Http\Controller;

use System\Request;

class ArticleController
{
    public function index()
    {
        echo 'index in articles';
    }

    public function destroy($id)
    {
        return Request::post();
    }
}