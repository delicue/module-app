<?php

use App\Session;

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
    return App\View::$data[$key] ?? $default;
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
    $model_class = 'App\\Models\\' . ucfirst($table_name);
    if (class_exists($model_class)) {
        return new $model_class();
    }
    throw new Exception("Model class {$model_class} does not exist.");
}

function generateCsrfToken(string $form_name): string
{
    if (Session::get("_csrf_token_$form_name") === null) {
        Session::set("_csrf_token_$form_name", bin2hex(random_bytes(32)));
    }
    return Session::get("_csrf_token_$form_name");
}

function verifyCsrfToken(string $form_name): bool
{
    return hash_equals(Session::get("_csrf_token_{$form_name}"), $_POST["_csrf_token_{$form_name}"]);
}

function render_component(string $template, array $data = []): string {
    extract($data); // Makes array keys available as variables
    ob_start(); // Start output buffering
    include "components/{$template}.php"; // Include the component template
    return ob_get_clean(); // Get and clean the buffered output
}