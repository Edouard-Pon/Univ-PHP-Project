<?php

namespace app\controllers;

use app\views\Errors as ErrorsView;

class Errors
{
    public function not_found_execute(): void
    {
        (new ErrorsView())->not_found_show();
    }
}
?>
