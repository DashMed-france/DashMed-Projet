<?php

namespace modules\controllers;

class logoutController
{
    public function get(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: /?page=homepage');
        exit();
    }
}