<?php

namespace app\controllers\comments;

use app\models\Comment as CommentModel;
use app\models\Post as PostModel;
use config\DataBase;
use PDO;

class Comment
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function add(array $commentData): void
    {
        $comment = new CommentModel($this->PDO);
        $post = new PostModel($this->PDO);

        if (empty($_SESSION['username'])) {
            $_SESSION['errorMessage'] = 'User session is not valid!';
            return;
        }

        // Validate and sanitize comment data
        $post_id = $commentData['post_id'];
        $user_id = $post['user_id'];
        $comment_text = htmlspecialchars($commentData['comment_text']);
        $timestamp = date('Y-m-d H:i:s');

        if (!empty($comment_text)) {
            // Add the comment to the database
            $comment->addComment([
                'post_id' => $post_id,
                'user_id' => $user_id,
                'comment_text' => $comment_text,
                'timestamp' => $timestamp
            ]);

            // Redirect back to the post or comments page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['errorMessage'] = 'Comment text is empty!';
        }
    }

}