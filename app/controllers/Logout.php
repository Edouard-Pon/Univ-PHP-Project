<?php

namespace app\controllers;

class LogoutController
{
    public function execute(): void
    {
        session_destroy();
        header('Location: /');
        exit();
    }
}
