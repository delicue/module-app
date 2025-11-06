<?php 

namespace App\Http;

use App\Log;

class Router {
    private array $routes = [];
    private array $routeData = [];

    public function getRoutes(): array {
        return $this->routes;
    }

    public function register($uri, $method, $action, array $data = []) {
        $this->routes[$method][$uri] = $action;
        $this->routeData[$uri] = $data;
    }

    /**
     * 
     * @param mixed $uri The request URI
     * @param mixed $method The HTTP method (GET, POST, etc.)
     */
    public function dispatch($uri, $method): string {
        Log::info("Attempting to dispatch route for {$method} {$uri}");
        if (isset($this->routes[$method][$uri])) {
            Log::info("Dispatching route for {$method} {$uri}. Action: " . print_r($this->routes[$method][$uri], true));
            $action = $this->routes[$method][$uri];
            if (is_callable($action)) {
                return call_user_func($action, ...$this->routeData[$uri]);
            } elseif (is_string($action)) {
                [$controller, $method] = explode('@', $action);
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $method)) {
                        return call_user_func([$controllerInstance, $method]);
                    }
                }
            }
        }
        Log::error("No route found for {$method} {$uri}");
        http_response_code(404);
        return view('errors/404.view');
    }
}