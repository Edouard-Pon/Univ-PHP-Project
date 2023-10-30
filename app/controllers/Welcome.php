<?php

namespace app\controllers;

use app\views\Welcome as WelcomeView;

class Welcome
{
    public function execute(): void
    {
        if (isset($_SESSION['password'])) {
            header('Location: /home');
            exit();
        }
        (new WelcomeView())->show();
    }
}
