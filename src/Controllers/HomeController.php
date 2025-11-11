<?php 

namespace App\Controllers;

use App\Database;
use App\Http\Route;
use App\Session;
use App\View;

class HomeController extends Controller {

    #[Route('/', 'GET')]
    public function __invoke(): string  {
        $users = Database::getInstance()->fetchAll("SELECT * FROM users");
        return View::render('pages/index.view', ['users' => $users, 'title' => 'Home Page']);
    }

    #[Route('/get-users', 'GET')]
    public function getUsers(): string {
        $db = Database::getInstance();
        $users = $db->fetchAll("SELECT * FROM users");
        return json_encode($users);
    }

    #[Route('/add-user', 'POST')]
    public function addUser(): string {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Invalid request method.');
            }
            if (!verifyCsrfToken('add_user')) {
                throw new \Exception('Invalid CSRF token.');
            }
            $name = $_POST['name'];
            $email = $_POST['email'];

            if (!empty($name) && !empty($email)) {
                $db = Database::getInstance();
                
                $stmt = $db->getConnection()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
            }
            header('Location: /');

            exit();
        }
        catch (\Exception $e) {
            http_response_code(400);
            return "Error: " . htmlspecialchars($e->getMessage());
        }
    }
}