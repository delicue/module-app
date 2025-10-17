<?php

function view(string $file): string
{
    return base_path("resources/views/{$file}.php");
}
function base_path($path = ''): string
{
    return __DIR__ . "/../../{$path}";
}

function public_path($path = ''): string
{
    return __DIR__ . "/../../public/{$path}";
}

function data(string $key, $default = null)
{
    return Deli\App\View::$data[$key] ?? $default;
}

function script(string $filename): string
{
    return '<script src="' . base_path($filename) . '"></script>';
}

function dd($data): void
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function model(string $table_name)
{
    $model_class = 'Deli\\App\\Models\\' . ucfirst($table_name);
    if (class_exists($model_class)) {
        return new $model_class();
    }
    throw new Exception("Model class {$model_class} does not exist.");
}

function generateCsrfToken(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}