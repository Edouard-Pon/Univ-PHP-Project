<?php

require_once '../config/autoloader.php';

use app\controllers\AdminController;
use app\controllers\ErrorsController;
use app\controllers\HomeController;
use app\controllers\LoginController;
use app\controllers\LogoutController;
use app\controllers\NewPostController;
use app\controllers\ProfileController;
use app\controllers\SignupController;
use app\controllers\TOSController;
use app\controllers\WelcomeController;

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
