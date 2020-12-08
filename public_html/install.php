<?php
use App\App;

use Core\FileDB;

require '../bootloader.php';


App::$db = new FileDB(DB_FILE);
App::$db->createTable('users');
App::$db->insertRow('users', ['user_name' => 'test1', 'password' => 'test', 'cash' => 0 ]);
//App::$db->createTable('money');