<?php

namespace app\controllers\tos;

use app\views\tos\TOS as TOSView;

class TOS
{
    public function execute(): void
    {
        (new TOSView())->show();
    }
}
?>
