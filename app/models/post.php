<?php

class Post
{
    public function __construct(private PDO $connection) {}

    public function getPosts(): ?array
    {
        $query = 'SELECT post_path, titre, auteur, message, id FROM posts';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute();

        $posts = array();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        return $posts ?: null;
    }
}
