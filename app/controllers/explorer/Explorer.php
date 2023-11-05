<?php

namespace app\controllers\explorer;

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
        $query=htmlspecialchars($postData['query']);

        if (($query)!=null) {
            $results = $explorer->getResults($postData);
            (new ExplorerView())->show($results);
        } else {
            (new ExplorerView())->show();
        }
    }
}