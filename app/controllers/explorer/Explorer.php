<?php

namespace app\controllers\explorer;
error_reporting(E_ERROR | E_PARSE);
use app\models\Explorer as ExplorerModel;

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
        if (isset($postData['query'])) {
            $query = htmlspecialchars($postData['query']);
            $results = $explorer->getResults($query);
            (new ExplorerView())->show($results);
        } else {
            (new ExplorerView())->show();
        }
    }
}