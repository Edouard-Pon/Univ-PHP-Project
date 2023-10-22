<?php

namespace app\models;

use PDO;

class PostModel
{
    public function __construct(private PDO $connection) {}

    public function getPosts($authorName = null): ?array
    {
        if ($authorName) {
            $query = 'SELECT post_path, titre, auteur, message, id FROM posts WHERE auteur = ?';
            $statement = $this->connection->prepare($query);
            if (!$statement) {
                error_log('Failed to prepare statement');
                return null;
            }

            $statement->execute([$authorName]);
        } else {
            $query = 'SELECT post_path, titre, auteur, message, id FROM posts';
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
        $query = 'INSERT INTO posts (titre, message, date, auteur, post_path) VALUES (?, ?, ?, ?, ?)';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute(array($data['post_title'], $data['post_text'], $data['post_date'], $data['post_author'], $data['dir'] . $data['file_name']));
    }

/*    public function RemovePost($data): void
    {
        $query = 'DELETE FROM posts WHERE id=?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute(array($data['post_title'], $data['post_text'], $data['post_date'], $data['post_author'], $data['dir'] . $data['file_name']));
    }*/
}
