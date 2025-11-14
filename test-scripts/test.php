<?php

require __DIR__ . '/../src/app/setup.php';

use App\Database;

//insert a record for testing
Database::getInstance()
    ->execute("INSERT INTO users (name, email) VALUES (:name, :email)", [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ]
);
dd(Database::getInstance()->fetchOne("SELECT * FROM users WHERE id = :id", ['id' => 1]));