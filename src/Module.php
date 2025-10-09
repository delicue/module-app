<?php 

namespace Deli\App;

class Module {
    private static array $values = [];

    public static function set(array $key_value): void {
        foreach ($key_value as $key => $value) {
            self::$values[$key] = $value;
        }
    }

    public static function get(string $key) {
        return self::$values[$key] ?? null;
    }

    public static function view($file, ?callable $func = null): string {
        if ($func) {
            call_user_func($func);
        }
        return self::base_path("resources/views/{$file}.php");
    }
    public static function base_path($path = ''): string {
        return __DIR__ . "/../{$path}";
    }

    public static function db(): Database {
        return Database::getInstance();
    }
}