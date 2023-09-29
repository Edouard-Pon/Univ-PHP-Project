<?php
include '../app/controllers/login.php';

try {
    if (isset($_SERVER['REQUEST_URI'])) {
        $route = $_SERVER['REQUEST_URI'];

        switch ($route) {
            case '/':
                (new LoginController())->execute();
                break;
            default:
                error_log('404 Not Found');
        }
    }
} catch (Exception) {

}

?>
