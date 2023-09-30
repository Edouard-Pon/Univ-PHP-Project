<?php
include '../app/views/welcome.php';

class WelcomeController
{
    public function execute(): void
    {
        (new WelcomeView())->show();
    }
}
?>
