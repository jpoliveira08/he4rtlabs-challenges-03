<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;
use Core\Model;
/**
 * Register Controller
 */
class Registration extends Controller
{

    private User $user;
    
    public function __construct()
    {
        $this->user = new User(Model::connectionCreator());
    }
    
    public function createAction(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($this->user->createUser($email, $password)) {
            header("Location: /home/login");
            exit;
        }
        header("Location: /home/register");
        exit;
    }
}
