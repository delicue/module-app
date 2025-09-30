<?php 

namespace Module;

use Closure;

class Router
{
    public static function get(string $path, callable | Closure | array $callback)
    {
        // Check if the request matches the route
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === $path) {
            // Call the appropriate callback
            if (is_callable($callback)) {
                call_user_func($callback);
            } elseif (is_array($callback) && count($callback) === 2) {
                [$controller, $method] = $callback;
                if (class_exists($controller) && method_exists($controller, $method)) {
                    (new $controller())->$method();
                }
            }
        }
    }

    public static function post(string $path, callable | Closure | array $callback)
    {
        // Check if the request matches the route
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === $path) {
            // Call the appropriate callback
            if (is_callable($callback)) {
                call_user_func($callback);
            } elseif (is_array($callback) && count($callback) === 2) {
                [$controller, $method] = $callback;
                if (class_exists($controller) && method_exists($controller, $method)) {
                    (new $controller())->$method();
                }
            }
        }
    }
}