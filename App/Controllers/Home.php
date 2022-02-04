<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller
{
    /**
     * Sign in page
     *
     * @return void
     */
    public function loginAction(): void
    {
        View::renderTemplate('Home/login.html');
    }

    /**
     * Sign up page
     *
     * @return void
     */
    public function registerAction(): void
    {
        View::renderTemplate('Home/register.html');
    }
}