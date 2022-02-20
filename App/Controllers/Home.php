<?php

declare(strict_types=1);

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
        View::renderTemplate('Home/login.html', [
            'invalid_credentials' => $this->session->getFlash('login_failed')
        ]);
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