<?php

namespace App\Forms;

class AddUserForm {

    public static $errors = [];

    public static function validate(array $data): bool {
        self::$errors = [];

        if (empty($data['name'])) {
            self::$errors['name'] = 'Name is required.';
        }

        if (empty($data['email'])) {
            self::$errors['email'] = 'Email is required.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            self::$errors['email'] = 'Invalid email format.';
        }

        return empty(self::$errors);
    }
}