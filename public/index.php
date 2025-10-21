<?php

require __DIR__ . '/../src/app/setup.php';

// Dispatch the request. This will populate any variables needed in the partials as well.
$content = $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

require view('partials/header');
require $content;
require view('partials/footer');