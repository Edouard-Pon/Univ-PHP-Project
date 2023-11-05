<?php

require_once __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('Europe/Paris');

use app\controllers\admin\Admin as AdminController;
use app\controllers\connections\Login as LoginController;
use app\controllers\connections\Logout as LogoutController;
use app\controllers\connections\Signup as SignupController;
use app\controllers\connections\Welcome as WelcomeController;
use app\controllers\errors\Errors as ErrorsController;
use app\controllers\explorer\Explorer as ExplorerController;
use app\controllers\home\Home as HomeController;
use app\controllers\posts\Post as NewPostController;
use app\controllers\posts\Post as PostController;
use app\controllers\profile\Profile as ProfileController;
use app\controllers\tos\TOS as TOSController;
use app\controllers\posts\FullPost as FullPostController;
use app\controllers\comments\Comment as CommentController;
use app\controllers\connections\Recovery as RecoveryController;

session_start();

try {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['login'])) {
            (new LoginController())->login($_POST);
        }

        if (isset($_POST['signup'])) {
            (new SignupController())->signup($_POST);
        }

        if (isset($_POST['post']))
        {
            (new NewPostController())->execute($_POST, $_FILES);
        }

        if (isset($_POST['query'])) {
            (new ExplorerController())->execute($_POST);
        }

        if (isset($_POST['save-profile']))
        {
            (new ProfileController())->save($_POST, $_FILES);
        }

        if (isset($_POST['comment']))
        {
            (new CommentController())->add($_POST);
        }

        if (isset($_POST['recovery'])) {
            (new RecoveryController())->changePassword($_POST);
        }
    }

    if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $route = ($_SERVER['REQUEST_URI'] === '/') ? '/' : explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        switch ($route[0]) {
            case '/':
                (new WelcomeController())->execute();
                break;
            case 'signup':
                (new SignupController())->execute();
                break;
            case 'login':
                (new LoginController())->execute();
                break;
            case 'home':
                (new HomeController())->execute();
                break;
            case 'admin':
                (new AdminController())->execute();
                break;
            case 'tos':
                (new TOSController())->execute();
                break;
            case 'logout':
                (new LogoutController())->execute();
                break;
            case 'explorer':
                (new ExplorerController())->execute();
                break;
            case 'profile':
                if (!isset($route[1])) {
                    (new ProfileController())->execute();
                    break;
                }
                if ($route[1] === 'edit') {
                    (new ProfileController())->edit();
                    break;
                }
                if (isset($route[4]) && $route[4] === 'delete' && $route[2] === 'post') {
                    (new PostController())->delete($route);
                    break;
                }
                if (isset($route[4]) && $route[4] === 'delete' && $route[2] === 'comment') {
                    (new CommentController())->delete($route);
                    break;
                }
                if (isset($route[2]) && $route[2] === 'post') {
                    (new FullPostController())->execute($route);
                    break;
                }
                (new ProfileController())->user($route[1]);
                break;
            case 'verification':
                if (!isset($route[1])) {
                    (new ErrorsController())->not_found_execute();
                    break;
                }
                (new SignupController())->emailVerification($route);
                break;
            case 'recovery':
                if (!isset($route[1])) {
                    (new RecoveryController())->execute();
                    break;
                }
                (new RecoveryController())->emailVerification($route);
                break;
            default:
                (new ErrorsController())->not_found_execute();
                break;
        }
    }
} catch (Exception) {

}
