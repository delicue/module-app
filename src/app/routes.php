<?php

use App\Http\Router;
use App\Module;

Module::addRouter('main', new Router());
Module::registerRoutesFromAttributes('main');

// $router->get('/', HomeController::class . '@index');
// $router->post('/add-user', HomeController::class . '@addUser');