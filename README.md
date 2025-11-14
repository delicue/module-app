# Users App

Inspired by the Laravel PHP framework, this app uses a lightweight structure meant to apply some basic concepts of
the Model-View-Control concept for web development.

## Purpose

- To demonstrate basic understanding and usage of the Model-View-Control concept for web development.
- To demonstrate ability to create a presentable frontend with HTML, CSS/TailwindCSS, JavaScript, and PHP.
- To demonstrate ability to manipulate DOM and handle events in JavaScript.
- To demonstrate ability to handle CRUD operations in backend, possibly using API
- To demonstrative ability to connect frontend to backend using router and AJAX requests,
and responding from server with appropriate data, including 404 error.

## Unique Features

- Routing is handled by using custom PHP Attributes to assign routes to specific methods in a given Controller.
These routes registered in `\App\Module::registerRoutesFromAttributes()` and the method is called in `/src/app/routes.php`.

## How to Run Application

First, ensure you have PHP 8.5 installed
Use the command `php serve` to run it in your local browser. By default, it is located at `https://localhost:3000`.
Alternatively, this can be run in Laravel Herd using the command `herd open` from this directory. Ensure Herd is installed before running command.

## Troubleshooting Notes

- if there are namespacing issues due to structural changes, run `composer dump-autoload` to ensure the composer.json file
effectuates the changes to the project.
