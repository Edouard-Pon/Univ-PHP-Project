<?php
include '../app/controllers/welcome.php';

try {
    if (isset($_SERVER['REQUEST_URI'])) {
        $route = $_SERVER['REQUEST_URI'];

        switch ($route) {
            case '/':
                (new WelcomeController())->execute();
                break;
            default:
                error_log('404 Not Found');
        }
    }
} catch (Exception) {

}

?>
