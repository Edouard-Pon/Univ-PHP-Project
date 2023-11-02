<?php

namespace app\views\admin;

use app\views\layouts\Layout;

class Admin
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
