<?php

namespace app\controllers\category;



use app\models\Category as CategoryModel;
use app\models\Post as PostModel;
use app\views\categories\PostsInCategory as CategoryView;
use config\DataBase;
use PDO;

class Categories
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute($categoryName): void
    {
        $post = new PostModel($this->PDO);
        $category = new CategoryModel($this->PDO);
        //Returns an array of post ids
        $foundposts = $category->getPostsInCategory($categoryName);

        //for every post id, get the info of said post
        foreach ($foundposts as $foundpostID) {
            $postInfo = $post->getPost($foundpostID['post_id']);
            if ($postInfo !== null) {
                $postsincategory[] = $postInfo;
            }
        }

        $allcategories = $category->getAllCategories();
        $categoriesNames = $category->getCategories();
        $selectedcategory = $categoryName;


        (new CategoryView())->show($postsincategory,$allcategories,$categoriesNames,$selectedcategory);
    }
}