<?php

use App\App;

require '../../bootloader.php';

if (!App::$session->getUser()) {
    header('Location: login.php');
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'cash' => [
            'label' => 'Pinigų kiekis',
            'type' => 'number',
            'validators' => [
                'validate_min_5',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įrašykite sumą',
                    'class' => 'input-field',
                ]
            ]
        ],

    ],
    'buttons' => [
        'send' => [
            'title' => 'Įdėti',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [

    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $is_valid = validate_form($form, $clean_inputs);
    if ($is_valid) {
        $file = file_to_array(DB_FILE);
        foreach ($file['users'] as $index => $user) {
            if ($user['user_name'] === $_SESSION['user_name']) {
                $row = App::$db->getRowWhere('users', ['user_name' => $_SESSION['user_name']]);
                $gems_add = intval($clean_inputs['cash'] * 100);
                $row['cash'] += $gems_add;
                $row['activity'] = ['veikla'=> 'add', 'suma' => $gems_add, 'date' => date('Y-m-d')];
                App::$db->updateRow('users', $index, $row);

            }
        }
        array_to_file($file, DB_FILE);
        $text = 'Pinigai įdėti sekmingai';
    } else {
        $text = 'Pinigai neįdėti';
    }
}


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
    <h2 class="tittle">Pinigų suma</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <p><?php if (isset($text)) print $text; ?></p>
</main>
</body>
</html>

