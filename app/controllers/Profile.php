<?php

namespace app\controllers;

use app\models\PostModel;
use app\models\UserModel;
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
        $user = new UserModel($this->PDO);
        $post = new PostModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts($_SESSION['username']);
            (new ProfileView())->show($user, $post);
        }
    }
}
