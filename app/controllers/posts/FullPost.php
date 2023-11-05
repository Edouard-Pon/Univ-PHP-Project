<?php

namespace app\controllers\posts;

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
        $categories = new CategoryModel($this->PDO);

        $dataPost = $post->getPost($route[3]);
        $PostCategories = $categories->getCategories($route[3]);
        $AllCategories = $categories->getCategories();
        $dataComments = $comments->getComments($route[3]);

        if ($dataPost === null) {
            header('Location: /home');
            exit();
        }

        (new FullPostController())->show($dataPost, $dataComments, $PostCategories, $AllCategories);
    }
}