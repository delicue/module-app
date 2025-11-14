<?php

exec('npm run build');

require __DIR__ . '/../../vendor/autoload.php';
require 'functions.php';
require 'routes.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../../')->load();

// Session::start();

// Create and register a shared EventDispatcher for the app
// Module::setDispatcher(new EventDispatcher());