<?php

use App\App;

require '../bootloader.php';

if (App::$session->getUser()) {
    header('Location: admin/add.php');
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'user_name' => [
            'label' => 'Vartotojo vardas',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',

            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk vartotojo vardą',
                    'class' => 'input-field',
                ],
            ],
        ],
        'password' => [
            'label' => 'Slaptažodis',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įveskite slaptažodį',
                    'class' => 'input-field',
                ],
            ],
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Prisijunkti',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
    'validators' => [
        'validate_login' => [
            'email',
            'password',
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $form_success = validate_form($form, $clean_inputs);

    if ($form_success) {
        App::$session->login($clean_inputs['user_name'], $clean_inputs['password']);

        $text = 'Login successful';
        header('Location: admin/buy.php');
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <?php include(ROOT . '/core/templates/nav.php'); ?>
</header>

<main>
    <h2 class="tittle">Prisijunkite</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <p><?php if (isset($text)) print $text; ?></p>
</main>
</body>
</html>