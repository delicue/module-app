<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/tools/functions.php';
require "/routing/routes.php";

exec('npm run build');

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

use Deli\App\Session;

Session::start();