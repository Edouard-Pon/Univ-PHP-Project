<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\Admin as AdminController;
use app\controllers\Errors as ErrorsController;
use app\controllers\Home as HomeController;
use app\controllers\Login as LoginController;
use app\controllers\Logout as LogoutController;
use app\controllers\NewPost as NewPostController;
use app\controllers\Profile as ProfileController;
use app\controllers\Signup as SignupController;
use app\controllers\TOS as TOSController;
use app\controllers\Welcome as WelcomeController;

session_start();

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
            case '/tos':
                (new TOSController())->execute();
                break;
            case '/logout':
                (new LogoutController())->execute();
                break;
            case '/profile':
                (new ProfileController())->execute();
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
        (new NewPostController())->execute($_POST, $_FILES);
    }

} catch (Exception) {

}
