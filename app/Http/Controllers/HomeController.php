<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Exception;

class HomeController
{


    /**
     * @throws Exception
     */
    public function index()
    {
        echo 1;
    }

    public function category($id)
    {
        $categories = ArticleCategory::all();

        var_dump($categories);
    }
}