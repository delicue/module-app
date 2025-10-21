<?php 

namespace Deli\App;

class Router {
    public array $routes = [];
    public array $routeData = [];

    public function get($uri, $action, array $data = []) {

        $this->routes['GET'][$uri] = $action;
        $this->routeData[$uri] = $data;
    }

    public function post($uri, $action, array $data = []) {

        $this->routes['POST'][$uri] = $action;
        $this->routeData[$uri] = $data;
    }

    /**
     * 
     * @param mixed $uri
     * @param mixed $method
     */
    public function dispatch($uri, $method): string {
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            if (is_callable($action)) {
                return call_user_func($action,);
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
        http_response_code(404);
        return view('errors/404.view');
    }
}