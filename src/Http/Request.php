<?php 

namespace App\Http;

class Request {
    public static function uri(): string {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return rtrim($uri, '/') ?: '/';
    }

    public static function method(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function all(): array {
        return $_REQUEST;
    }

    public static function queryParameters(): array {
        return $_GET;
    }
}