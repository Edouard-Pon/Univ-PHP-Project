<?php

namespace app\models;

use PDO;

class Comment
{
    public function __construct(private PDO $connection) {}

    public function getComments(int $postID): ?array
    {
        $query = 'SELECT comment_id, post_id, comment_text, comment_author, timestamp FROM comments WHERE post_id = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$postID]);
        $comments = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }

        return $comments ?: null;
    }

    public function getCommentNbforPost($postID = null): ?int
    {
        $query = 'SELECT count(*) FROM comments WHERE post_id = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$postID]);
        $comments = 0;

        $comments[] = $statement->fetch(PDO::FETCH_ASSOC);

        return $comments ?: null;
    }

    public function addComment($data): void
    {
        $query = 'INSERT INTO comments (post_id, comment_author, comment_text, timestamp) VALUES (?, ?, ?, ?)';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$data['post_id'], $data['username'], $data['comment_text'], $data['timestamp']]);
    }

    public function deleteCommentByID($id): void
    {
        $query = 'DELETE FROM comments WHERE comment_id = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$id]);
    }
}