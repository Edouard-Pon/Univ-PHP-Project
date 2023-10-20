<?php

namespace app\controllers;

use app\models\PostModel;
use app\models\UserModel;
use app\views\HomeView;
use config\DataBase;
use PDO;

class HomeController
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
            $post = $post->getPosts();
            (new HomeView())->show($user, $post);
        }
    }
}
