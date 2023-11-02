<?php

namespace app\controllers\connections;

use app\models\User as UserModel;
use app\views\connections\Signup as SignupView;
use config\DataBase;
use PDO;

class Signup
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        if (isset($_SESSION['password'])) {
            header('Location: /home');
            exit();
        }
        (new SignupView())->show();
    }

    public function signup(array $postData): void
    {
        $data = [
            'username' => htmlspecialchars($postData['username']),
            'nickname' => htmlspecialchars($postData['nickname']),
            'password' => sha1($postData['password']),
            'email' => htmlspecialchars($postData['email']),
            'number' => htmlspecialchars($postData['number']),
            'location' => htmlspecialchars($postData['location']),
            'gender' => htmlspecialchars($postData['gender']),
        ];
        $user = new UserModel($this->PDO);
        if (!empty($data['username']) &&
            !empty($data['nickname']) &&
            !empty($data['password']) &&
            !empty($data['email']) &&
            !empty($data['number']) &&
            !empty($data['location']) &&
            !empty($data['gender']))
        {
            $user->setUser($data);
            $userData = $user->getUser($data['username'], $data['password']);
            if ($userData !== null)
            {
                $_SESSION['username'] = $userData['name'];
                $_SESSION['password'] = $userData['password'];
                $_SESSION['id'] = $userData['id'];
                $_SESSION['admin'] = $userData['admin'];
                $user->setLastConnection();
                header('Location: /home');
            } else {
                $errorMessage = 'Error cannot get User! Please try to login!';
                $_SESSION['errorMessage'] = $errorMessage;
                header('Location: /login');
            }
            exit();
        } else {
            $errorMessage = 'Veuillez compléter tous les champs...';
            $_SESSION['errorMessage'] = $errorMessage;
        }
    }
}
