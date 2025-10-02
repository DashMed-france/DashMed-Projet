<?php

namespace modules\controllers;

use modules\views\dashboardView;

class dashboardController
{
    public function get(): void
    {
        if (!$this->isUserLoggedIn())
        {
            header('Location: /?page=login');
        }
        $view = new dashboardView();
        $view->show();
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['email']);
    }
}