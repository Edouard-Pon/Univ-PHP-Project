<?php

namespace app\controllers;

use app\views\ProfileView;
use config\DataBase;
use PDO;

class ProfileController
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        (new ProfileView())->show();
    }
}
