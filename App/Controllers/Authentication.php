<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\{User, Email};
use Core\{Controller, Model, Session};

/**
 * Register Controller
 */
class Authentication extends Controller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User(Model::connectionCreator());
        $this->session = new Session();
    }

    public function authenticateAction(): void
    {
        if ($this->user->authenticateUser(new Email($_POST['email']), $_POST['password'])) {
            $this->session->setFlash('success', "Thanks for login");
            header("Location: /dashboard/index");
            exit;
        }
        $this->session->setFlash('success', "Login error");
        header("Location: /home/login");
        exit;
    }
}

