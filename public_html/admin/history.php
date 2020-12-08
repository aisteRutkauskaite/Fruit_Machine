<?php

use App\App;

require '../../bootloader.php';

if (!App::$session->getUser()) {
    header('Location: login.php');
    exit();
}

$table_rows = App::$db->getRowsWhere('users');
var_dump($table_rows[0]['activity']);
$table = [
    'headers' => [
        'Data',
        'Veikla',
        'Kiekis'
    ],


]

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
    <?php include(ROOT . '/core/templates/nav.php'); ?>
</header>
<main>
    <h2 class="tittle">Istorija:</h2>
        <?php require ROOT . '/core/templates/table.tpl.php'; ?>

</main>
</body>
</html>
