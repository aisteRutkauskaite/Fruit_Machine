<?php

use App\App;

/**
 * Generate navigation depending on login status
 *
 * @return array|string[]
 */
function nav(): array
{
    if (App::$session->getUser()) {
        return [
            'HOME' => '/index.php',
            'BUY GEMS' => '/admin/buy.php',
            'HISTORY' => '/admin/history.php',
            'LOGOUT' => '/logout.php',
        ];
    } else {
        return [
            'HOME' => '/index.php',
            'LOGIN' => '/login.php',
            'REGISTER' => '/register.php',
        ];
    }
}


