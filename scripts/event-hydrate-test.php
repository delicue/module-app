<?php
require __DIR__ . '/../vendor/autoload.php';

use App\EventHydrator;
use App\Module;

$dispatcher = Module::getDispatcher();
$dispatcher->on('page.loaded', function($user){ /* noop */ });

$dispatcher->emit('page.loaded', ['id' => 1, 'name' => 'Alice']);
$dispatcher->emit('flash', ['type' => 'info', 'message' => 'Welcome']);

// Render hydration script
EventHydrator::render();
