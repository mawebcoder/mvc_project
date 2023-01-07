<?php

use System\Route;
use App\Http\Controller\UserController;

Route::get('/users', [UserController::class, 'index']);

Route::get('/users/edit/{id}', [UserController::class, 'edit']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/users/create', [UserController::class, 'create']);

Route::put('/users/{id}', [UserController::class, 'update']);

Route::delete('/users/{id}', [UserController::class, 'delete']);