<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;
use Core\Model;
/**
 * Register Controller
 */
class Authentication extends Controller
{

    private User $user;
    
    public function __construct()
    {
        $this->user = new User(Model::connectionCreator());
    }
    
    public function authenticateAction(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($this->user->authenticateUser($email, $password)) {
            View::renderTemplate('Dashboard/index.html');
            return;
        }
        View::renderTemplate('Home/login.html');
    }
}

