<?php

namespace app\models;
error_reporting(E_ERROR | E_PARSE);
use PDO;

class Category
{
    public function __construct(private PDO $connection) {}

    public function getCategories($postID = null): ?array
    {
        if ($postID === null) {
            $query = 'SELECT DISTINCT category_name FROM categories';
            $statement = $this->connection->prepare($query);

            if (!$statement) {
                error_log('Failed to prepare statement');
                return null;
            }

            $statement->execute();
            $categories = [];

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row['category_name'];
            }

            if (empty($categories)) {
                $categories[] = "None";
            }
        } else {
            $query = 'SELECT post_id, category_name FROM categories WHERE post_id = ?';
            $statement = $this->connection->prepare($query);

            if (!$statement) {
                error_log('Failed to prepare statement');
                return null;
            }

            $statement->execute([$postID]);
            $categories = [];

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row['category_name'];
            }

            if (empty($categories)) {
                $categories[] = "None";
            }
        }

        return $categories ?: null;
    }

    public function getCategoryByPostID($postId): ?string
    {
        $query = 'SELECT category_name FROM categories WHERE post_id = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$postId]);
        $categories = $statement->fetch(PDO::FETCH_ASSOC);

        return $categories['category_name'] ?: null;
    }

    public function getPostsInCategory($postCategory): ?array
    {
        $query = 'SELECT * FROM categories WHERE category_name = ?';

        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$postCategory]);

        $postIDS = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $postIDS ?: null;
    }

    public function addCategory(int $postID, string $category): void
    {
        $query = 'INSERT INTO categories (post_id, category_name) VALUES (?, ?)';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            $errorInfo = $this->connection->errorInfo();
            error_log('Database error: ' . implode(' | ', $errorInfo));
            return;
        }

        if ($category === 'None') return;

        try {
            $statement->execute([$postID, $category]);
        } catch (\PDOException $e) {
            error_log('Error in db, not important!');
        }
    }

    public function deleteCategory($category_name): void
    {
        $query = 'DELETE FROM categories WHERE category_name = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$category_name]);
    }

    public function getCategoriesCount($postID): ?int
    {
        $query = 'SELECT count(*) FROM categories WHERE post_id = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$postID]);

        $categories = $statement->fetch(PDO::FETCH_ASSOC);

        return $categories['count(*)'] ?: 0;
    }

    public function deleteCategoriesOfDeletedPost($postID): void
    {
        $query = 'DELETE FROM categories WHERE post_id = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$postID]);
    }

    public function getAllCategories(): ?array
    {
        $query = 'SELECT * FROM categories';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([]);

        $categories = array();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $row;
        }

        return $categories ?: null;
    }
}