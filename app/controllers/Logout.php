<?php

namespace app\controllers;

class Logout
{
    public function execute(): void
    {
        session_destroy();
        header('Location: /');
        exit();
    }
}
