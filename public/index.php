<?php

use App\Log;
use App\Module;

require __DIR__ . '/../src/app/setup.php';

// Dispatch the request. This will populate any variables needed in the partials as well.
$content = Module::getRouter('main')->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

Log::info("Dispatched {$_SERVER['REQUEST_METHOD']} request for {$_SERVER['REQUEST_URI']}");

require view('partials/header');
require $content;
require view('partials/footer');