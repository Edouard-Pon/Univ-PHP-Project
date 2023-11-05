<?php

namespace app\controllers\home;

use app\models\Category as CategoryModel;
use app\models\Post as PostModel;
use app\models\User as UserModel;
use app\views\home\Home as HomeView;
use config\DataBase;
use PDO;

class Home
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
        $category = new CategoryModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts();
            $AllCategories = $category->getCategories();
            (new HomeView())->show($user, $post, $AllCategories);
        }
    }
}
