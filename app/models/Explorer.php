<?php

namespace app\models;
error_reporting(E_ERROR | E_PARSE);

use PDO;

class Explorer
{
    public function __construct(private PDO $connection) {}

    public function getResults($criteria): ?array
    {
        $postQuery = "SELECT * FROM posts WHERE post_text LIKE :criteria";
        $userQuery = "SELECT * FROM user WHERE username LIKE :criteria";
        $categoryQuery = "SELECT * FROM categories WHERE category_name LIKE :criteria";

        try {
            $postResults = $this->connection->prepare($postQuery);
            $postResults->execute(['criteria' => "%$criteria%"]);

            $userResults = $this->connection->prepare($userQuery);
            $userResults->execute(['criteria' => "%$criteria%"]);

            $categoryResults = $this->connection->prepare($categoryQuery);
            $categoryResults->execute(['criteria' => "%$criteria%"]);

        } catch (\PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
        }

        return array_merge($postResults->fetchAll(), $userResults->fetchAll(), $categoryResults->fetchAll()) ?: null;
    }
}
