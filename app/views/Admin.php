<?php

namespace app\views;

class AdminView
{
    public function show(): void
    {
        ob_start();
?>
<div>
    You are logged in as an Administrator! WIP
</div>
<?php
        (new Layout('PasX - Admin', ob_get_clean()))->show();
    }
}
?>
