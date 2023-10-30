<?php

namespace app\controllers;

use app\models\User as UserModel;
use app\views\Login as LoginView;
use config\DataBase as DataBase;
use PDO;

class Login
{

    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        (new LoginView())->show();
    }

    public function login(array $postData): void
    {
        if (isset($_SESSION['password'])) {
            header('Location: /home');
            exit();
        }
        $username = htmlspecialchars($postData['username']);
        $password = sha1($postData['password']);
        $user = new UserModel($this->PDO);
        if (!empty($username) && !empty($password))
        {
            $userData = $user->getUser($username, $password);
            if ($userData !== null)
            {
                $_SESSION['username'] = $userData['username'];
                $_SESSION['password'] = $userData['password'];
                $_SESSION['id'] = $userData['id'];
                $_SESSION['admin'] = $userData['admin'];
                $user->setLastConnection();
                header('Location: /home');
                exit();
            } else {
                $errorMessage = 'Votre mot de passe ou nom d\'utilisateur est incorrect...';
                $_SESSION['errorMessage'] = $errorMessage;
            }
        } else {
            $errorMessage = 'Veuillez compléter tous les champs...';
            $_SESSION['errorMessage'] = $errorMessage;
        }
    }
}
