<?php

namespace App;

use App\EventDispatcher;
use App\Http\Router;
use ReflectionClass;

final class Module
{
    /**
     * 
     *
     * @var array
     */
    private static array $routers = [];

    /**
     * Shared EventDispatcher instance (lazy-initialized).
     */
    private static ?EventDispatcher $dispatcher = null;

    /**
     * Set (or clear) the shared EventDispatcher instance.
     */
    public static function setDispatcher(?EventDispatcher $dispatcher): void
    {
        self::$dispatcher = $dispatcher;
    }

    /**
     * Get (or lazily create) the shared EventDispatcher instance.
     */
    public static function getDispatcher(): EventDispatcher
    {
        return self::$dispatcher ??= new EventDispatcher();
    }

    public static function getRouter(string $name): Router
    {
        self::$routers[$name] ??= new Router();
        return self::$routers[$name];
    }

    public static function hasRouter(string $name): bool
    {
        return isset(self::$routers[$name]);
    }

    public static function addRouter(string $name, Http\Router $router): void
    {
        self::$routers[$name] = $router;
    }

    public static function getRouters(): array
    {
        return self::$routers;
    }

    public static function clearRouters(): void
    {
        self::$routers = [];
    }

    /**
     * Register routes from the @Route attributes in controller methods.
     * @param string $routerName
     * @return void
     */
    public static function registerRoutesFromAttributes(string $routerName = 'main'): void
    {
        if (!self::hasRouter($routerName)) {
            Log::error("Router '{$routerName}' does not exist. Please create it before registering routes.");
            return;
        }
        Log::info("Registering routes from attributes into router '{$routerName}'");
        $router = self::getRouter($routerName);

        $controllerClasses = [];
        // Collect all class names from Controllers folder
        $controllerFiles = glob(__DIR__ . '/Controllers/*.php');
        foreach ($controllerFiles as $file) {
            // require_once $file;
            $className = basename($file, '.php');
            $controllerClasses[] = "App\\Controllers\\$className";
        }

        // dd($controllerClasses);
        foreach ($controllerClasses as $subclass) {
            // Create a ReflectionClass for the subclass
            $reflectionClass = new ReflectionClass($subclass);

            // Get methods of the subclass
            $methods = $reflectionClass->getMethods();
        
            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Http\Route::class);
                foreach ($attributes as $attribute) {
                    /** @var Http\Route $routeInstance */
                    $routeInstance = $attribute->newInstance();
                    Log::info("Found route attribute: [{$routeInstance->method}] {$routeInstance->uri} in {$method->class}::{$method->getName()}");
                    self::getRouter($routerName)->register(
                        $routeInstance->uri,
                        $routeInstance->method,
                        $reflectionClass->getName() . '@' . $method->getName(),
                        $routeInstance->data
                    );
                    Log::info("Registered route [{$routeInstance->method}] {$routeInstance->uri} to router '{$routeInstance->routerName}'");
                }
            }
        }
    }
}
