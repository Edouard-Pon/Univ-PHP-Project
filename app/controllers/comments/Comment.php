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

        $post_id = $commentData['post_id'];
        $username = $commentData['username'];
        $comment_text = htmlspecialchars($commentData['text']);
        $timestamp = date('Y-m-d H:i:s');

        if (!empty($comment_text)) {
            $comment->addComment([
                'post_id' => $post_id,
                'username' => $username,
                'comment_text' => $comment_text,
                'timestamp' => $timestamp
            ]);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['errorMessage'] = 'Comment text is empty!';
        }
    }

    public function delete(array $route): void
    {
        $post = new PostModel($this->PDO);
        $postAuthor = '';
        if (isset($route[5])) $postAuthor = $post->getPost($route[5])['post_author'];
        if (isset($_SESSION['username']) && $_SESSION['username'] === $route[1] && $route[2] === 'comment' ||
            isset($_SESSION['admin']) && $_SESSION['admin'] && $route[2] === 'comment' ||
            isset($_SESSION['username']) && $postAuthor !== '' && $postAuthor === $_SESSION['username']) {

            $comment = new CommentModel($this->PDO);
            $comment->deleteCommentByID($route[3]);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['errorMessage'] = 'You cannot delete this comment!';
        }
        header('Location: /home');
        exit();
    }
}