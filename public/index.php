<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/tools/functions.php';

use Deli\App\Controllers\HomeController;
use Deli\App\Database;
use Deli\App\Router;
use Deli\App\Session;

echo exec('npm run build');

Session::start();

$router = new Router();
$db = Database::getInstance();

$router->get('/', HomeController::class . '@index');
// $router->get('/about', HomeController::class . '@about');
// $router->post('/submit', HomeController::class . '@submit');

require view('partials/header');
require $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
require view('partials/footer');