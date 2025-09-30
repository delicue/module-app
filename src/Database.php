<?php 

namespace Module;

use PDO;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $this->connection = new PDO('sqlite:' . __DIR__ . '/../databases/database.sqlite');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}