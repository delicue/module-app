<?php

use Deli\App\Controllers\HomeController;
use Deli\App\Controllers\UserController;
use Deli\App\Router;

$router = new Router();

$router->get('/', HomeController::class . '@index');
$router->post('/add-user', HomeController::class . '@addUser');
$router->get('/users', UserController::class . '@show', ['id' => 1]);
// $router->get('/about', HomeController::class . '@about');
// $router->post('/submit', HomeController::class . '@submit');