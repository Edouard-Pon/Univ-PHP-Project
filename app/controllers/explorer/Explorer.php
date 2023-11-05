<?php

namespace app\controllers\explorer;

use app\models\Post as PostModel;
use app\models\Category as CategoryModel;

use app\views\explorer\Explorer as ExplorerView;
use config\DataBase;
use PDO;

class Explorer
{

    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        $post = new PostModel($this->PDO);
        $category = new CategoryModel($this->PDO);

        $post = $post->getPosts();
        $AllCategories = $category->getCategories();

        (new ExplorerView())->show($post, $AllCategories);
    }

}