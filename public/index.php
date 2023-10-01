<?php
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
            default:
                (new ErrorsController())->not_found_execute();
                break;
        }
    }
} catch (Exception) {

}

?>
