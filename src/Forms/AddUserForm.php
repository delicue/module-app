<?php

namespace App\Forms;

use App\Forms\Validator;

class AddUserForm {

    public static $errors = [];
    public static $rules = [
        'name' => [
            'required' => true,
            'minLength' => 2,
            'maxLength' => 100,
        ],
        'email' => [
            'required' => true,
            'email' => true,
            'maxLength' => 255,
        ],
    ];

    public static function validate(array $data): bool {

        self::$errors = Validator::validate($data, self::$rules);
        return empty(self::$errors);
    }
}