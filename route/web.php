<?php

use System\Router;
use App\Http\Controller\UserController;

Router::get('/users', [UserController::class, 'index']);

Router::get('/users/edit/{id}', [UserController::class, 'edit']);

Router::post('/users', [UserController::class, 'post']);

Router::get('/users/create', [UserController::class, 'create']);

Router::put('/users/{id}', [UserController::class, 'update']);

Router::delete('/users/{id}', [UserController::class, 'delete']);