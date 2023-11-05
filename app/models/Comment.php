<?php

namespace app\models;
error_reporting(E_ERROR | E_PARSE);
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

    public function getCommentsCount($postID): ?int
    {
        $query = 'SELECT count(*) FROM comments WHERE post_id = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$postID]);

        $comments = $statement->fetch(PDO::FETCH_ASSOC);

        return $comments['count(*)'] ?: 0;
    }

    public function addComment($data): void
    {
        $query = 'INSERT INTO comments (post_id, comment_author, comment_text, timestamp) VALUES (?, ?, ?, ?)';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        try {
            $statement->execute([$data['post_id'], $data['username'], $data['comment_text'], $data['timestamp']]);
        } catch (\PDOException $e) {
            error_log($e->getMessage());
        }
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

    public function deleteAllPostComments($postID): void
    {
        $query = 'DELETE FROM comments WHERE post_id = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$postID]);
    }

    public function deleteAllUserComments($username): void
    {
        $query = 'DELETE FROM comments WHERE comment_author = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        try {
            $statement->execute([$username]);
        } catch (\PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
        }
    }
}