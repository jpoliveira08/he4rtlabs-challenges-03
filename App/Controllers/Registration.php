<?php

namespace App\Controllers;

use App\Models\Credentials\{Email, Password};
use App\Models\User;
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
        $userCreated = $this->user->createUser(new Email($_POST['email']), new Password($_POST['password']));
        if (empty($userCreated['errorCause'])) {
            header("Location: /home/login");
            return;
        }
        $this->redirectForFailedRegistration($userCreated['errorCause']);
    }

    private function redirectForFailedRegistration(string $errorCause): void
    {
        if ($errorCause === 'email') {
            $this->session->setFlash('emailAlreadyRegistered', 'Email is already registered');
            header("Location: /home/register");
            return;
        }
        $this->session->setFlash('commonPassword', 'Password is too weak or common to use');
        header("Location: /home/register");
        return;
    }
}
