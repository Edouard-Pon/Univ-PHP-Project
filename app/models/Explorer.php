<?php

namespace app\models;
error_reporting(E_ERROR | E_PARSE);

use PDO;
use function Symfony\Component\String\s;

class Explorer
{
    public function __construct(private PDO $connection) {}

    public function getResults($criteria): ?array
    {
        $postQuery = "SELECT * FROM posts WHERE post_text LIKE :criteria";
        $userQuery = "SELECT username FROM user WHERE username LIKE :criteria";
        $categoryQuery = "SELECT DISTINCT category_name FROM categories WHERE category_name LIKE :criteria";

        try {
            $postResults = $this->connection->prepare($postQuery);
            $postResults->execute(['criteria' => "%$criteria%"]);
            $results['posts'] = $postResults->fetchAll();

            $userResults = $this->connection->prepare($userQuery);
            $userResults->execute(['criteria' => "%$criteria%"]);
            $results['users'] = $userResults->fetchAll();

            $categoryResults = $this->connection->prepare($categoryQuery);
            $categoryResults->execute(['criteria' => "%$criteria%"]);
            $results['categories'] = $categoryResults->fetchAll();

        } catch (\PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            return null; // Return null on error
        }

        $results['criteria'] = $criteria;

        return $results;
    }
}