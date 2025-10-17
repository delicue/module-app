<?php 

namespace Deli\App\Controllers;

use Deli\App\Database;
use Deli\App\View;

class HomeController {
    public function index(): string  {
        $db = Database::getInstance();
        $users = $db->fetchAll("SELECT * FROM users");
        return View::render('index.view', ['users' => $users, 'title' => 'Home Page']);
    }

    public function addUser(): string {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        if (!empty($name)) {
            $db = Database::getInstance();
            $stmt = $db->getConnection()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }
        header('Location: /');

        exit();
    }
}