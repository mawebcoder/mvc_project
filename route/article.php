<?php

use System\Route;

Route::get('/articles', [\App\Http\Controller\ArticleController::class, 'index']);

Route::put('/articles/{id}', [\App\Http\Controller\ArticleController::class, 'destroy']);