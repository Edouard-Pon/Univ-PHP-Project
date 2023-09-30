<?php
class ErrorsView
{
    public function not_found_show(): void
    {
        ob_start();
        ?>
        <div>
            404 - Page Not Found!
        </div>
        <?php
        (new Layout('PasX - 404 Not Found', ob_get_clean(), 'null'))->show();
    }
}
?>
