<?php

require __DIR__ . '/../../vendor/autoload.php';
require 'functions.php';
require 'routes.php';

exec('npm run build');

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../../')->load();

use App\Session;

Session::start();