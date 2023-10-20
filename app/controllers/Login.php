<?php

namespace app\controllers;

use app\models\UserModel;
use app\views\LoginView;
use config\DataBase;
use PDO;

class LoginController
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
        $username = htmlspecialchars($postData['username']);
        $password = sha1($postData['password']);
        $user = new UserModel($this->PDO);
        if (!empty($username) && !empty($password))
        {
            $userData = $user->getUser($username, $password);
            if ($userData !== null)
            {
                $_SESSION['username'] = $userData['name'];
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