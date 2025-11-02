<?php
declare(strict_types=1);

namespace App;

use App\Controllers\Controller;
use App\EventDispatcher;
use App\Http\Router;

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
        if (!isset(self::$routers[$name])) {
            self::$routers[$name] = new Router();
        }
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

    public static function registerRouteAttributes(string $routerName = 'main'): void
    {
        $router = self::getRouter($routerName);

        // Register routes using reflection class attributes
        $reflectionClass = new \ReflectionClass();

        $methods = $reflectionClass->getMethods();
        foreach ($methods as $method) {
            $attributes = $method->getAttributes(Http\Route::class);
            foreach ($attributes as $attribute) {
                /** @var Http\Route $routeInstance */
                $routeInstance = $attribute->newInstance();
                Log::info("Found route attribute: [{$routeInstance->method}] {$routeInstance->uri} in {$method->class}::{$method->getName()}");
                if($router instanceof Router) {
                    $router->register(
                        $routeInstance->method,
                        $routeInstance->uri,
                        $method::class . '@' . $method->getName(),
                        $routeInstance->data
                    );
                    Log::info("Registered route [{$routeInstance->method}] {$routeInstance->uri} to router '{$routeInstance->routerName}'");
                }
            }
        }
    }
}
