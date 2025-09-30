<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('Module\\', __DIR__ . '/../src/');

exec('npm run build');

use Module\Module;

require Module::view('partials/header', ['title' => 'My App']);
// require Module::view('index', ['title' => 'Home Page']);

$
require Module::view('partials/footer');