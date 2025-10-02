<?php

namespace modules\controllers;

use modules\views\homepageView;

class homepageController
{
    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }
        $view = new homepageView();
        $view->show();
    }

    public function index(): void
    {
        $this->get();
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['email']);
    }
}
