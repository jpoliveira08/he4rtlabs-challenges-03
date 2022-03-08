<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\{Controller, View};
use App\Models\Analytics\DailyReport;

class Dashboard extends Controller
{
    /**
     * Dashboard index page
     *
     * @return void
     */
    public function indexAction(): void
    {
        View::renderTemplate('Dashboard/index.html', [
            'successfully_logged' => $this->session->getFlash('login_success')
        ]);
    }

    public function dailyAction()
    {
        $dailyReport = new DailyReport();
        $dailyReport->amountOfRegister();
    }
}
