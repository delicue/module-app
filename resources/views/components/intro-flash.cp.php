<?php
// Example: emit a flash event from PHP so it can be hydrated to JS (use shared Module dispatcher)
if (class_exists('\App\Module')) {
    $dispatcher = \App\Module::getDispatcher();
    $dispatcher->emit('flash', ['type' => 'success', 'message' => 'Welcome — to the User database. Just add or remove a user!']);
}
?>

<!-- Flash container (will be populated by hydrated PHP events) -->
<div id="php-flash" class="hidden fixed top-4 right-4 bg-green-600 text-white p-3 rounded shadow-lg z-50"></div>