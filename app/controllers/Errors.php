<?php

namespace app\controllers;

use app\views\ErrorsView;

class ErrorsController
{
    public function not_found_execute(): void
    {
        (new ErrorsView())->not_found_show();
    }
}
?>
