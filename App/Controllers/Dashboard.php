<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Login as ModelsLogin;
Use Core\View;

class Dashboard extends Controller
{
    /**
     * Show the index page of Dashboard
     *
     * @return void
     */
    public function indexAction(): void
    {
        $loginMaded = (new ModelsLogin($_POST))->makeLogin();
        if (!$loginMaded) {
            //throw new \Exception("Email or password incorrects");
            header('Location: /');
            return;
        }
        View::renderTemplate('Dashboard/index.html');
    }

}
