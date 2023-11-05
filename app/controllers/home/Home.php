<?php

namespace app\controllers\home;
error_reporting(E_ERROR | E_PARSE);
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
            $postData = $post->getPosts();
            $categories = $category->getAllCategories();
            $categoriesNames = $category->getCategories();
            (new HomeView())->show($postData, $categories, $categoriesNames);
        }
    }
}
