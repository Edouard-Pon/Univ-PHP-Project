<?php

namespace app\controllers;

use app\models\UserModel;
use app\views\AdminView;
use config\DataBase;
use PDO;

class AdminController
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        $user = new UserModel($this->PDO);
        if ($user->isAdmin())
        {
            (new AdminView())->show();
        } else {
            header('Location: /home');
            exit();
        }
    }
}
