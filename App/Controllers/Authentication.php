<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\{User, Email};
use Core\{Controller, Session, Model};

/**
 * Register Controller
 */
class Authentication extends Controller
{
    private User $user;
    private Email $email;

    public function __construct()
    {
        $this->user = new User(Model::connectionCreator());
    }

    public function authenticateAction(): void
    {
        $this->email = new Email($_POST['email']);
        $password = $_POST['password'];
        if ($this->user->authenticateUser($this->email, $password)) {
            //(new Session)->setFlash('success', 'Login');
            header("Location: /dashboard/index");
            exit;
        }
        header("Location: /home/login");
        exit;
    }
}

