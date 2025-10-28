<?php

namespace App\Models;

use App\Database;

class User extends Model {
    protected string $table = 'users';

    public static function getAll(): array {
        return Database::getInstance()::all('users');
    }
}