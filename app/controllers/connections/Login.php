<?php

namespace app\controllers\connections;
error_reporting(E_ERROR | E_PARSE);
use app\models\User as UserModel;
use app\views\connections\Login as LoginView;
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
        $password = htmlspecialchars($postData['password']);
        $user = new UserModel($this->PDO);
        if (!empty($username) && !empty($password))
        {
            $userData = $user->getUser($username);
            if ($userData !== null)
            {
                if (password_verify($password, $userData['password']))
                {
                    $_SESSION['username'] = $userData['username'];
                    $_SESSION['password'] = $userData['password'];
                    $_SESSION['id'] = $userData['id'];
                    $_SESSION['admin'] = $userData['admin'];
                    $_SESSION['profile_picture'] = $userData['profile_picture'];
                    $user->setLastConnection();
                    header('Location: /home');
                    exit();
                } else {
                    $errorMessage = 'Votre mot de passe est incorrect...';
                    $_SESSION['errorMessage'] = $errorMessage;
                    header('Location: /login');
                    exit();
                }
            } else {
                $errorMessage = 'Votre nom d\'utilisateur est incorrect...';
                $_SESSION['errorMessage'] = $errorMessage;
                header('Location: /login');
                exit();
            }
        } else {
            $errorMessage = 'Veuillez compléter tous les champs...';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /login');
            exit();
        }
    }
}
