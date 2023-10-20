<?php

namespace app\controllers;

use app\views\TOSView;

class TOSController
{
    public function execute(): void
    {
        (new TOSView())->show();
    }
}
?>
