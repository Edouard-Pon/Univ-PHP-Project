<?php

namespace app\controllers;

use app\views\TOS as TOSView;

class TOS
{
    public function execute(): void
    {
        (new TOSView())->show();
    }
}
?>
