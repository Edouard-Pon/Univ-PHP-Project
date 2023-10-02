<?php
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

    public function login(string $username, string $password): void
    {
        $user = new User($this->PDO);
        if (!empty($username) && !empty($password))
        {
            $user = $user->getUser($username, $password);
            if ($user !== null)
            {
                $_SESSION['username'] = $user['name'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['id'] = $user['id'];
                header('Location: /home');
                exit();
            } else {
                $errorMessage = 'Votre mot de passe ou nom d\'utilisateur est incorrect...';
                (new LoginView())->show($errorMessage);
            }
        } else {
            $errorMessage = 'Veuillez compléter tous les champs...';
            (new LoginView())->show($errorMessage);
        }
    }
}
