<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/tools/functions.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

use Deli\App\Controllers\HomeController;
use Deli\App\Router;

exec('npm run build');

$router = new Router();

$router->get('/', HomeController::class . '@index');
$router->post('/add-user', HomeController::class . '@addUser');
// $router->get('/about', HomeController::class . '@about');
// $router->post('/submit', HomeController::class . '@submit');

$content = $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

require view('partials/header');
require $content;
require view('partials/footer');