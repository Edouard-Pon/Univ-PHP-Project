<?php
class HomeController
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        $user = new User($this->PDO);
        $post = new Post($this->PDO);
        if (!isset($_SESSION['password']))
        {
            header('Location: /');
            exit();
        } else {
            $user = $user->getUser($_SESSION['username'], $_SESSION['password']);
            $post = $post->getPosts();
            (new HomeView())->show($user, $post);
        }
    }
}
