<?php

namespace app\models;

use PDO;

class Post
{
    public function __construct(private PDO $connection) {}

    public function getPosts($authorName = null): ?array
    {
        if ($authorName) {
            $query = 'SELECT post_path, post_title, post_author, post_text, id FROM posts WHERE post_author = ?';
            $statement = $this->connection->prepare($query);
            if (!$statement) {
                error_log('Failed to prepare statement');
                return null;
            }

            $statement->execute([$authorName]);
        } else {
            $query = 'SELECT post_path, post_title, post_author, post_text, id FROM posts';
            $statement = $this->connection->prepare($query);
            if (!$statement) {
                error_log('Failed to prepare statement');
                return null;
            }

            $statement->execute();
        }

        $posts = array();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        return $posts ?: null;
    }

    public function addPost($data): void
    {
        $query = 'INSERT INTO posts (post_title, post_text, post_date, post_author, post_path) VALUES (?, ?, ?, ?, ?)';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute(array($data['post_title'], $data['post_text'], $data['post_date'], $data['post_author'], $data['dir'] . $data['file_name']));
    }

    public function deletePost($id): void
    {
        $query = 'DELETE FROM posts WHERE id=?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$id]);
    }

    public function getPostImage($id): ?array
    {
        $query = 'SELECT post_path FROM posts WHERE id = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$id]);

        $post = $statement->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }
}
