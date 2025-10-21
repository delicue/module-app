<?php 

namespace App;

class View {
    public static array $data = [];
    public static function render($file, array $data = []): string {
        static::$data = $data;
        extract($data);
        return __DIR__ . "/../resources/views/{$file}.php";
    }
}