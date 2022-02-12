<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Core\{Controller, View, Model};

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
            header("Location: /dashboard/index");
            exit;
        }
        header("Location: /home/login");
        exit;
    }
}

