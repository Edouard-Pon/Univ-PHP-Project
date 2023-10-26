<?php

namespace app\controllers;

use app\models\Post as PostModel;
use app\models\User as UserModel;
use app\views\Profile as ProfileView;
use config\DataBase;
use PDO;

class Profile
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
