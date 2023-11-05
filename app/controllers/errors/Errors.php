<?php

namespace app\controllers\errors;
error_reporting(E_ERROR | E_PARSE);
use app\views\errors\Errors as ErrorsView;

class Errors
{
    public function not_found_execute(): void
    {
        (new ErrorsView())->not_found_show();
    }
}
?>
