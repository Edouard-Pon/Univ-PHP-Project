<?php
class ErrorsView
{
    public function not_found_show(): void
    {
        ob_start();
?>
<p>
    404 - Page Not Found!
</p>
<?php
        (new Layout('PasX - 404 Not Found', ob_get_clean()))->show();
    }
}
?>
