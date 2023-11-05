<?php

namespace app\controllers\connections;
error_reporting(E_ERROR | E_PARSE);
class Logout
{
    public function execute(): void
    {
        session_destroy();
        header('Location: /');
        exit();
    }
}
