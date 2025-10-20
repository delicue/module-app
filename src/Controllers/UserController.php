<?php 

namespace Deli\App\Controllers;

use Deli\App\Database;
use Deli\App\View;

class UserController {
    public function index(): string {
        $users = Database::getInstance()->fetchAll("SELECT * FROM users");
        return View::render('users.index', ['users' => $users]);
    }

    public function show($id): string {
        $db = Database::getInstance();
        $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user) {
            return View::render('users/show.view', ['user' => $user]);
        } else {
            http_response_code(404);
            return 'User not found';
        }
    }
}