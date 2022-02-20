<?php

namespace App\Controllers;

use App\Models\{User, Email};
use Core\{Controller, Model};

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
        $password = $_POST['password'];
        if ($this->user->createUser(new Email($_POST['email']), $password)) {
            header("Location: /home/login");
            exit;
        }
        header("Location: /home/register");
        exit;
    }
}
