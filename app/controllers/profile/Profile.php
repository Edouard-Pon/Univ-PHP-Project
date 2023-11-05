<?php

namespace app\controllers\profile;

use app\models\Post as PostModel;
use app\models\Category as CategoryModel;
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
        $user = new UserModel($this->PDO);
        $post = new PostModel($this->PDO);
        $category = new CategoryModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts($_SESSION['username']);
            $AllCategories = $category->getCategories();
            (new ProfileView())->show($user, $post, $AllCategories, false, true);
        }
    }

    public function edit(): void
    {
        $user = new UserModel($this->PDO);
        $post = new PostModel($this->PDO);
        $category = new CategoryModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts($_SESSION['username']);
            $AllCategories = $category->getCategories();
            //Im not sure isOwner = null is a good idea
            (new ProfileView())->show($user, $post, $AllCategories, true, true);
        }
    }

    public function save(array $postData, array $fileData): void
    {
        $user = new UserModel($this->PDO);
        $userData = $user->getUser($_SESSION['username']);
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
                    $user->changeProfilePicture($data['filePath'], $_SESSION['username']);
                } else {
                    $errorMessage .= 'Sorry, there was an error uploading your file';
                    $_SESSION['errorMessage'] = $errorMessage;
                    header('Location: /profile');
                    exit();
                }
            }
        }
        if (isset($postData['nickname']) && $postData['nickname'] !== $userData['nickname']) {
            $user->changeNickname($_SESSION['username'], htmlspecialchars($postData['nickname']));
        }
        if (isset($postData['location']) && $postData['location'] !== $userData['location']) {
            $user->changeLocation($_SESSION['username'], htmlspecialchars($postData['location']));
        }
        if (isset($postData['gender']) && $postData['gender'] !== $userData['gender']) {
            $user->changeGender($_SESSION['username'], htmlspecialchars($postData['gender']));
        }
        if (isset($postData['username']) && $postData['username'] !== $_SESSION['username']) {
            if (!$user->isUsernameExist(htmlspecialchars($postData['username']))) {
//                $user->changeUsername(htmlspecialchars($postData['username']), $_SESSION['username']);
//                $_SESSION['username'] = htmlspecialchars($postData['username']);
                $errorMessage .= 'Username change function is not available yet!';
                $_SESSION['errorMessage'] = $errorMessage;
            } else {
                $errorMessage .= 'The username: "' . htmlspecialchars($postData['username'] . '" is already in use!');
                $_SESSION['errorMessage'] = $errorMessage;
            }
        }

        header('Location: /profile');
        exit();
    }

    public function user(string $username): void
    {
        $user = new UserModel($this->PDO);
        $posts = new PostModel($this->PDO);
        $category = new CategoryModel($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUserPublic($username);
            $posts = $posts->getPosts($username);
            $AllCategories = $category->getCategories();
            $isOwner = false;
            if ($username === $_SESSION['username']) $isOwner = true;
            (new ProfileView())->show($user, $posts,  $AllCategories, false, $isOwner);
        }
    }
}
