<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Register Controller
 */
class Register extends Controller
{
    /**
     * Show the register page
     *
     * @return void
     */
    public function indexAction(): void
    {
        View::renderTemplate('Register/index.html');
    }
}
