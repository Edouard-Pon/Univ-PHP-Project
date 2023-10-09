<?php
class SignupController
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        (new SignupView())->show();
    }

    public function signup($data): void
    {
        $user = new User($this->PDO);
        if (!empty($data['username']) &&
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
?>
