<?php

namespace app\views\explorer;

use app\views\layouts\Layout;

class Explorer
{
    public function show($postData, $userData): void
    {
        ob_start();
        ?>
<form method="GET" action="/explorer">
    <input type="text" name="query" placeholder="Search...">
    <button type="submit">Search</button>
</form>
        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'profile'))->show();
    }
}
?>