<?php

namespace app\models;

use PDO;

class Comment
{
    public function __construct(private PDO $connection) {}

    public function getComments($postID = null): ?array
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

        $statement->execute([$data['post_id'], $data['comment_author'], $data['comment_text'], $data['timestamp']]);
    }
}