<?php

namespace app\controllers\posts;

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
        $dataPost = $post->getPost($route[3]);

        if ($dataPost === null) {
            header('Location: /home');
            exit();
        }

        (new FullPostController())->show($dataPost);
    }
}