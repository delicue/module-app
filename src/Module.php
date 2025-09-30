<?php 

namespace Module;

class Module {
    public static function view($file, $data = []): string {
        extract($data);
        return self::base_path("resources/views/{$file}.php");
    }
    public static function base_path($path = ''): string {
        return __DIR__ . "/../{$path}";
    }
}