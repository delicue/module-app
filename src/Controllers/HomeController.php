<?php 

namespace Delicue\Module\Controllers;

use Module\Module;

class HomeController {
    public function __invoke(): void {
        Module::view('index', ['title' => 'Home Page']);
    }
}