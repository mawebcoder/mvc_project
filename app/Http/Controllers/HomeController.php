<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Exception;

class HomeController
{


    /**
     * @throws Exception
     */
    public function index(): void
    {
        $title = 'courses';

        view('home', compact('title'));
    }

    public function category($id)
    {
        $categories = ArticleCategory::all();

        var_dump($categories);
    }
}