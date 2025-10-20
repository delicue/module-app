<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/tools/functions.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

use Deli\App\Controllers\HomeController;
use Deli\App\Controllers\UserController;
use Deli\App\Router;
use Deli\App\Session;

exec('npm run build');

Session::start();

$router = new Router();

$router->get('/', HomeController::class . '@index');
$router->post('/add-user', HomeController::class . '@addUser');
$router->get('/users/{id}', UserController::class . '@show');
// $router->get('/about', HomeController::class . '@about');
// $router->post('/submit', HomeController::class . '@submit');

// Dispatch the request. This will populate any variables needed in the partials as well.
$content = $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

require view('partials/header');
require $content;
require view('partials/footer');