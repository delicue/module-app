<?php
// scripts/event-example.php

require __DIR__ . '/../vendor/autoload.php';

use App\Module;

$dispatcher = Module::getDispatcher();

$dispatcher->on('greet', function ($name) {
    echo "Hello, $name\n";
});

$dispatcher->once('greet-once', function ($name) {
    echo "Greeting once: $name\n";
});

echo "Emit greet:\n";
$dispatcher->emit('greet', 'Alice');
$dispatcher->emit('greet', 'Bob');

echo "Emit greet-once twice:\n";
$dispatcher->emit('greet-once', 'Carol');
$dispatcher->emit('greet-once', 'Dave');

// Output listeners for debugging
print_r($dispatcher->getListeners());
