<?php

namespace app\controllers\tos;
error_reporting(E_ERROR | E_PARSE);
use app\views\tos\TOS as TOSView;

class TOS
{
    public function execute(): void
    {
        (new TOSView())->show();
    }
}
?>
