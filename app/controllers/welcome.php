<?php
class WelcomeController
{
    public function execute(): void
    {
        (new WelcomeView())->show();
    }
}
?>
