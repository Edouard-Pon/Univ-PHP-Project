<?php

namespace app\models;

namespace app\models;

use PDO;

class Explorer
{
    public function __construct(private PDO $connection) {}

    public function getResults($criteria): ?array
    {
        // Define your SQL queries to search relevant tables (posts, users, categories).
        $postQuery = "SELECT * FROM posts WHERE post_text LIKE :criteria";
        $userQuery = "SELECT * FROM users WHERE username LIKE :criteria";
        $categoryQuery = "SELECT * FROM categories WHERE category_name LIKE :criteria";

        // Prepare and execute SQL queries for each table.
        $postResults = $this->connection->prepare($postQuery);
        $postResults->execute(['criteria' => "%$criteria%"]);

        $userResults = $this->connection->prepare($userQuery);
        $userResults->execute(['criteria' => "%$criteria%"]);

        $categoryResults = $this->connection->prepare($categoryQuery);
        $categoryResults->execute(['criteria' => "%$criteria%"]);

        return array_merge($postResults->fetchAll(), $userResults->fetchAll(), $categoryResults->fetchAll());
    }
}
