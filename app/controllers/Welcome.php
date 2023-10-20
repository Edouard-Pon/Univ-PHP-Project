<?php

namespace app\controllers;

use app\views\WelcomeView;

class WelcomeController
{
    public function execute(): void
    {
        (new WelcomeView())->show();
    }
}
