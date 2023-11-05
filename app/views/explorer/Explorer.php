<?php

namespace app\views\explorer;

use app\views\layouts\Layout;

class Explorer
{
    public function show($postData, $userData): string
    {
        ob_start();
        ?>
        <form method="GET" action="/explorer">
            <input type="text" name="query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        <?php
        return ob_get_clean();
    }
}
?>