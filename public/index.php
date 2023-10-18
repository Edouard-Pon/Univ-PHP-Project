<?php
session_start();

include_once '../config/autoloader.php';

try {
    if (isset($_SERVER['REQUEST_URI'])) {
        $route = $_SERVER['REQUEST_URI'];

        switch ($route) {
            case '/':
                (new WelcomeController())->execute();
                break;
            case '/signup':
                (new SignupController())->execute();
                break;
            case '/login':
                (new LoginController())->execute();
                break;
            case '/home':
                (new HomeController())->execute();
                break;
            case '/admin':
                (new AdminController())->execute();
                break;
            case '/termsofuse':
                (new TermsOfUseController())->execute();
                break;
            case '/create':
                (new CreatePost())->execute();
                break;
            case '/logout':
                (new LogoutController())->execute();
                break;
            default:
                (new ErrorsController())->not_found_execute();
                break;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        (new LoginController())->login($_POST);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
        (new SignupController())->signup($_POST);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post']))
    {
        (new NewPost())->execute($_POST, $_FILES);
    }

} catch (Exception) {

}
