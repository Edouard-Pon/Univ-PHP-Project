<?php
class AdminController
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        $user = new User($this->PDO);
        if ($user->isAdmin())
        {
            (new AdminView())->show();
        } else {
            header('Location: /home');
            exit();
        }
    }
}
