<?php

namespace app\controllers\connections;
error_reporting(E_ERROR | E_PARSE);
use app\views\connections\Welcome as WelcomeView;

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
