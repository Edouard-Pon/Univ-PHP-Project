<?php

namespace app\controllers\errors;

use app\views\errors\Errors as ErrorsView;

class Errors
{
    public function not_found_execute(): void
    {
        (new ErrorsView())->not_found_show();
    }
}
?>
