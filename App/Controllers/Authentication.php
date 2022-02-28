<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Credentials\{Email, Password};
use App\Models\User;
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

    /**
     * User Authentication
     *
     * @return void
     */
    public function authenticateAction(): void
    {
        if ($this->user->authenticateUser(new Email($_POST['email']), new Password($_POST['password']))) {
            $this->session->setFlash('login_success', "You have successfully logged in!");
            header("Location: /dashboard/index");
            return;
        }
        $this->session->setFlash('login_failed', "Invalid credentials. Please try again.");
        header("Location: /home/login");
        return;
    }
}

