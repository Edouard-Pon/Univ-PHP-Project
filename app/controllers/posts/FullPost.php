<?php

namespace app\controllers\posts;
error_reporting(E_ERROR | E_PARSE);
use app\models\Category as CategoryModel;
use app\models\Comment as CommentModel;
use app\models\Post as PostModel;
use app\views\posts\FullPost as FullPostController;
use config\DataBase;
use PDO;

class FullPost
{

    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(array $route): void
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /');
            exit();
        }
        $post = new PostModel($this->PDO);
        $comments = new CommentModel($this->PDO);
        $category = new CategoryModel($this->PDO);

        $dataPost = $post->getPost($route[3]);
        $postCategory = $category->getCategoryByPostID($route[3]);
        $categoriesNames = $category->getCategories();
        $dataComments = $comments->getComments($route[3]);

        if ($dataPost === null) {
            header('Location: /home');
            exit();
        }

        (new FullPostController())->show($dataPost, $dataComments, $postCategory, $categoriesNames);
    }
}