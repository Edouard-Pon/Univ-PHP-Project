<?php
class SignupController
{
    public function execute(): void
    {
        (new SignupView())->show();
    }
}
?>
