<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Http\Route;
use App\Http\Router;
use App\Module;

Module::registerRouteAttributes('main');

// $router->get('/', HomeController::class . '@index');
// $router->post('/add-user', HomeController::class . '@addUser');
// $router->get('/users/{id}', UserController::class . '@show');
// $router->get('/about', HomeController::class . '@about');
// $router->post('/submit', HomeController::class . '@submit');