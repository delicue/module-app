<?php
// require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/app/setup.php';

use App\Controllers\HomeController;

// echo '<h2>Classes in HomeController</h2>';
// dd(get_class_methods(HomeController::class));

echo '<h2>Reflection of HomeController Methods</h2>';
dd(new \ReflectionClass(HomeController::class)->getMethods());