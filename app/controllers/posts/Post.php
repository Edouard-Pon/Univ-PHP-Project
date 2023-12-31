<?php

namespace app\controllers\posts;
error_reporting(E_ERROR | E_PARSE);
use app\models\Post as PostModel;
use app\models\Comment as CommentModel;
use app\models\Category as CategoryModel;
use config\DataBase;
use PDO;

class Post
{

    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(array $postData, array $fileData): void
    {
        $post = new PostModel($this->PDO);
        $category = new CategoryModel($this->PDO);
        $allowedImageFormats = array("jpg", "jpeg", "png", "gif", "mp4");
        $errorMessage = '';
        $fileSizeLimitMB = [
            'image' => 5 * 1048576,
            'gif' => 15 * 1048576
        ];

        if (empty($_SESSION['username'])) {
            $errorMessage .= 'User session is not valid!';
            $_SESSION['errorMessage'] = $errorMessage;
            return;
        }

        if (isset($fileData['image']) && $fileData['image']['error'] === UPLOAD_ERR_OK) {
            $file_type = pathinfo($fileData['image']['name'], PATHINFO_EXTENSION);
            $file_name = $_SESSION['username'] . $post->getNextID() . '.' . $file_type;
            $file_size = $fileData['image']['size'];

            $data = [
                'dir' => 'posts/' . $_SESSION['username'] . '/',
                'file_name' => $file_name,
                'file_type' => $file_type,
                'file_size' => $file_size,
                'post_title' => htmlspecialchars($postData['title']),
                'post_text' => htmlspecialchars($postData['text']),
                'post_date' => date('Y-m-d H:i:s', time()),
                'post_author' => htmlspecialchars($_SESSION['username'])
            ];

            error_log(json_encode($data));

            if (!is_dir($data['dir'])) {
                mkdir($data['dir'], 0777, true);
            }

            if (!in_array(strtolower($data['file_type']), $allowedImageFormats)) {
                $errorMessage .= 'Wrong file type!';
            }

            if ($data['file_size'] > $fileSizeLimitMB['image']) {
                $errorMessage .= 'File size is to big!';
            }

            if (!empty($errorMessage)) {
                $_SESSION['errorMessage'] = $errorMessage;
            } else {
                if (move_uploaded_file($fileData['image']['tmp_name'], $data['dir'] . $data['file_name'])) {
                    $post->addPost($data);

                    //Gets last post_id inserted and categorie(s) from form and adds them to category table
                    //ADD CASE WHERE CUSTOM_CATEGORY IS SELECTED BUT NO CATEGORIES ARE ACTUALLY ADDED
                    $postId = $this->PDO->lastInsertId('post_id');
                    if ((isset($postData['categories'])) && ($postData['categories']==='new_category') && !empty($postData['new_category'])) {
                        $categories = $postData['custom_category'];
                    } else if ((isset($postData['categories'])) && ($postData['categories']==='new_category') && empty($postData['new_category'])){
                        $categories = 'None';
                    } else if (empty($postData['categories']) && !($postData['categories']==='new_category')){
                        $categories = 'None';
                    } else {
                        $categories = $postData['categories'];
                    }

                    $category->addCategory($postId, $categories);

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    $errorMessage .= 'Sorry, there was an error uploading your file';
                    $_SESSION['errorMessage'] = $errorMessage;
                }
            }
        } else {
            $data = [
                'post_title' => htmlspecialchars($postData['title']),
                'post_text' => htmlspecialchars($postData['text']),
                'post_date' => date('Y-m-d H:i:s', time()),
                'post_author' => htmlspecialchars($_SESSION['username'])
            ];
            error_log($data['post_date']);
            if (!empty($data['post_title'] || !empty($data['post_text']))) {
                $post->addPost($data);

                //Gets last post_id inserted and categorie(s) from form and adds them to category table
                $postId = $this->PDO->lastInsertId('post_id');
                if ((isset($postData['categories'])) && ($postData['categories']==='new_category')) {
                    $categories = $postData['custom_category'];
                } else {
                    $categories = $postData['categories'];
                }

                $category->addCategory($postId, $categories);

            } else {
                $_SESSION['errorMessage'] = 'Post content is empty!';
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function delete($route): void
    {
        if (isset($_SESSION['username']) && $_SESSION['username'] === $route[1] && $route[2] === 'post' && isset($route[3]) ||
            isset($_SESSION['admin']) && $_SESSION['admin'] && $route[2] === 'post' && isset($route[3])) {

            $post = new PostModel($this->PDO);
            $comment = new CommentModel($this->PDO);
            $category = new CategoryModel($this->PDO);

            $commentsCount = $comment->getCommentsCount($route[3]);

            if ($commentsCount !== 0) {
                $comment->deleteAllPostComments($route[3]);
            }

            $postImage = $post->getPostImage($route[3]);

            if (!empty($postImage['post_path'])) {
                if (file_exists($postImage['post_path'])) {
                    unlink($postImage['post_path']);
                }
            }

            $categoryCount = $category->getCategoriesCount($route[3]);

            if ($categoryCount !== 0) {
                $category->deleteCategoriesOfDeletedPost($route[3]);
            }

            $post->deletePost((int)$route[3]);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['errorMessage'] = 'You cannot delete this post!';
        }
        header('Location: /home');
        exit();
    }
}
