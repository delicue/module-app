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
}