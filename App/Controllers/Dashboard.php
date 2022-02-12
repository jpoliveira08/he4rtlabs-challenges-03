<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\{Controller, View};

class Dashboard extends Controller
{
    /**
     * Dashboard index page
     *
     * @return void
     */
    public function indexAction(): void
    {
        View::renderTemplate('Dashboard/index.html');
    }
}