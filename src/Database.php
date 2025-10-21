<?php 

namespace App;

use PDO;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO('sqlite:' . __DIR__ . '/databases/database.db');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Log::info("Connected to the SQLite database successfully.");
        } catch (\PDOException $e) {
            Log::error("Database connection failed: " . $e->getMessage());
            die("Database connection failed: " . $e->getMessage());
        }
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

    public static function fetchAll($query, $params = []): array {
        $stmt = self::getInstance()->getConnection()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function execute($query, $params = []): bool {
        $stmt = self::getInstance()->getConnection()->prepare($query);
        return $stmt->execute($params);
    }

    public static function all($table): array {
        $query = "SELECT * FROM :table";
        return self::fetchAll($query, [$table]);
    }
}