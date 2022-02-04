<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;
use Core\Model;
/**
 * Login controller
 * 
 * 
 */
class Authentication extends Controller
{
    
    /**
     * Authentication the user
     *
     * @return void
     */
    public function authenticateAction(): void
    {
        $user = new User(Model::connectionCreator());
        View::renderTemplate('Login/index.html');
    }

}
