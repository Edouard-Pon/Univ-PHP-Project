<?php

namespace app\controllers;

use app\models\User as UserModel;
use app\views\Admin as AdminView;
use config\DataBase;
use PDO;

class Admin
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
