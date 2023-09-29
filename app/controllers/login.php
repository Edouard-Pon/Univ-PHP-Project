<?php
include '../app/views/login.php';

class LoginController
{
    public function execute(): void
    {
        (new LoginView())->show();
    }
}
?>
