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
            'ADD' => '/admin/add.php',
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


