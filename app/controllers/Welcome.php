<?php

namespace app\controllers;

use app\views\Welcome as WelcomeView;

class Welcome
{
    public function execute(): void
    {
        (new WelcomeView())->show();
    }
}
