<?php

namespace app\views;

class ErrorsView
{
    public function not_found_show(): void
    {
        ob_start();
?>
<style>
    p {
        text-align: center;
        font-size: 30px;
    }
    body {
        display: grid;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
</style>
<p>
    404 - Page Not Found! ¯\_(ツ)_/¯
</p>
<?php
        (new Layout('PasX - 404 Not Found', ob_get_clean()))->show();
    }
}
?>
