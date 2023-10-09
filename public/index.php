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
        $data = [
            'username' => htmlspecialchars($_POST['username']),
            'password' => sha1($_POST['password'])
        ];
        (new LoginController())->login($data['username'], $data['password']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
        $data = [
            'username' => htmlspecialchars($_POST['username']),
            'password' => sha1($_POST['password']),
            'email' => htmlspecialchars($_POST['email']),
            'number' => htmlspecialchars($_POST['number']),
            'location' => htmlspecialchars($_POST['location']),
            'gender' => htmlspecialchars($_POST['gender']),
        ];
        (new SignupController())->signup($data);
    }

} catch (Exception) {

}

?>
