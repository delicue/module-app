<?php 

namespace Deli\App;

class Router {
    public array $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action, array $data = []) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri, $method) {
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            if (is_callable($action)) {
                return call_user_func($action);
            } elseif (is_string($action)) {
                list($controller, $method) = explode('@', $action);
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $method)) {
                        return call_user_func([$controllerInstance, $method]);
                    }
                }
            }
        }
        http_response_code(404);
        return '404 Not Found';
    }
}