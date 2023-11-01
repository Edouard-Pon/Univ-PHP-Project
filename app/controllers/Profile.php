<?php

namespace app\controllers;

//use app\models\Comment as CommentModel;
use app\models\Post as PostModel;
use app\models\User as UserModel;
use app\views\profile\Profile as ProfileView;
use config\DataBase;
use PDO;

class Profile
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
//        $comments = new CommentModel($this->PDO);
        $user = new UserModel($this->PDO);
        $post = new PostModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts($_SESSION['username']);
//            $comments = $comments->getComments();
            (new ProfileView())->show($user, $post, false, true);
        }
    }

    public function edit(): void
    {
        $user = new UserModel($this->PDO);
        $post = new PostModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts($_SESSION['username']);
            (new ProfileView())->show($user, $post, true);
        }
    }

    public function save(array $postData, array $fileData): void
    {
        $allowedImageFormats = array("jpg", "jpeg", "png", "gif");
        $errorMessage = '';
        $fileSizeLimitMB = [
            'image' => 5 * 1048576,
            'gif' => 15 * 1048576
        ];

        if (empty($_SESSION['username'])) {
            $errorMessage .= 'User session is not valid!';
        }

        if (isset($fileData['image']) && $fileData['image']['error'] === UPLOAD_ERR_OK) {

            $file_type = pathinfo($fileData['image']['name'], PATHINFO_EXTENSION);
            $file_name = $_SESSION['username'];
            $file_size = $fileData['image']['size'];

            $data = [
                'dir' => 'profiles/' . $_SESSION['username'] . '/',
                'file_name' => $file_name,
                'file_type' => $file_type,
                'file_size' => $file_size,
                'username' => $postData['username'],
                'filePath' => 'profiles/' . $_SESSION['username'] . '/' . $file_name . '.jpg'
            ];

            if (!is_dir($data['dir'])) {
                mkdir($data['dir'], 0777, true);
            }

            if (file_exists($data['filePath'])) {
                unlink($data['filePath']);
            }

            if (!in_array(strtolower($data['file_type']), $allowedImageFormats)) {
                $errorMessage .= 'Wrong file type!';
            }

            if ($data['file_size'] > $fileSizeLimitMB['image']) {
                $errorMessage .= 'Image size is to big!';
            }

            if (!empty($errorMessage)) {
                $_SESSION['errorMessage'] = $errorMessage;
            } else {
                $image = imagecreatefromstring(file_get_contents($fileData['image']['tmp_name']));

                list($imgWidth, $imgHeight) = getimagesize($fileData['image']['tmp_name']);
                $scaleX = $imgWidth / $postData['image-w'];
                $scaleY = $imgHeight / $postData['image-h'];

                $x = $postData['crop-x'] * $scaleX;
                $y = $postData['crop-y'] * $scaleY;
                $width = $postData['crop-w'] * $scaleX;
                $height = $width;

                $croppedImage = imagecreatetruecolor($width, $height);
                imagecopyresampled($croppedImage, $image, 0, 0, $x, $y, $width, $height, $width, $height);

                imagejpeg($croppedImage, $data['dir'] . $data['file_name'] . '.jpg');

                imagedestroy($image);
                imagedestroy($croppedImage);

                if (file_exists($data['filePath'])) {
                    (new UserModel($this->PDO))->update($data);
                    header('Location: /profile');
                    exit();
                } else {
                    $errorMessage .= 'Sorry, there was an error uploading your file';
                    $_SESSION['errorMessage'] = $errorMessage;
                }
            }
        }
    }

    public function user(string $username): void
    {
        $user = new UserModel($this->PDO);
        $posts = new PostModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUserPublic($username);
            $posts = $posts->getPosts($username);
            $isOwner = false;
            if ($username === $_SESSION['username']) $isOwner = true;
            (new ProfileView())->show($user, $posts, false, $isOwner);
        }
    }
}
