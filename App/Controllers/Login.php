<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Login controller
 * 
 * 
 */
class Login extends Controller
{
    /**
     * Before filter
     *
     * @return void
     */
    protected function before(): void
    {
        //echo "(before) ";
        //return false;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after(): void
    {
        //echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction(): void
    {
        //echo 'Hello from the index action in the Home controller!';
        //View::render('Home/index.php', [
        //    'name' => 'Dave',
        //    'colours' => ['red', 'green', 'blue']
        //]);
        View::renderTemplate('Login/index.html');
    }
}
