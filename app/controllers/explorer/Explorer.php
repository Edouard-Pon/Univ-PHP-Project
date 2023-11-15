<?php

namespace app\controllers\explorer;
error_reporting(E_ERROR | E_PARSE);
use app\models\Explorer as ExplorerModel;
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

    public function execute(array $postData = null): void
    {
        $explorer = new ExplorerModel($this->PDO);
        $categories = new CategoryModel($this->PDO);
        if (isset($postData['query'])) {
            $query = htmlspecialchars($postData['query']);
            $results = $explorer->getResults($query);
            $allCategories = $categories->getAllCategories();
            $categoriesNames = $categories->getCategories();
            (new ExplorerView())->show($results,$categoriesNames,$allCategories);
        } else {
            $allCategories = $categories->getAllCategories();
            $categoriesNames = $categories->getCategories();
            (new ExplorerView())->show($allCategories,$categoriesNames,null);
        }
    }
}