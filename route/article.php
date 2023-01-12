<?php

use System\Route;

Route::get('/articles', [\App\Http\Controller\ArticleController::class, 'index']);