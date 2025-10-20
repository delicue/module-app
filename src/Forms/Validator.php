<?php

namespace Deli\App\Forms;

class Validator {

    public static function validate(array $data, array $rules): array {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule => $ruleValue) {
                switch ($rule) {
                    case 'required':
                        if ($ruleValue && empty($data[$field])) {
                            $errors[$field] = ucfirst($field) . ' is required.';
                        }
                        break;
                    case 'email':
                        if ($ruleValue && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                            $errors[$field] = 'Invalid email format.';
                        }
                        break;
                    // Additional validation rules can be added here
                    case 'minLength':
                        if (strlen($data[$field] ?? '') < $ruleValue) {
                            $errors[$field] = ucfirst($field) . " must be at least $ruleValue characters long.";
                        }
                        break;
                    case 'maxLength':
                        if (strlen($data[$field] ?? '') > $ruleValue) {
                            $errors[$field] = ucfirst($field) . " must be no more than $ruleValue characters long.";
                        }
                        break;
                }
            }
        }

        return $errors;
    }
}