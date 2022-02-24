<?php

namespace App\Controllers;

use App\Models\{User, Email};
use Core\{Controller, Model, Session};

/**
 * Register Controller
 */
class Registration extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User(Model::connectionCreator());
        $this->session = new Session();
    }
    
    public function createAction(): void
    {
        $userCreated = $this->user->createUser(new Email($_POST['email']), $_POST['password']);
        if ($userCreated['success']) {
            header("Location: /home/login");
            exit;
        }
        switch ($userCreated['errorCause']) {
            case 'email':
                $this->session->setFlash('emailAlreadyRegistered', 'Email is already registered');
                $this->failRegistrationRedirect();
                break;
            case 'password':                    
                $this->session->setFlash('commonPassword', 'Password is too weak or common to use');
                $this->failRegistrationRedirect();
                break;
        }
    }

    private function failRegistrationRedirect(): void
    {
        header("Location: /home/register");
        exit;
    }
}
