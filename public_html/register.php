<?php

use App\App;

require '../bootloader.php';

if (App::$session->getUser()) {
    header('Location: login.php');
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
                'validate_user_unique',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įrašykite savo vartotojo vardą',
                    'class' => 'input-field',
                ]
            ]
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
                ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Slaptažodžio pakartojimas',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Pakartokite slaptažodį',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Registruokites',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $success = validate_form($form, $clean_inputs);
    if ($success) {
        unset($clean_inputs['password_repeat']);

        App::$db->insertRow('users', $clean_inputs + ['cash' => 0] + ['activity' => '']);


        header('Location: login.php');
    } else {
        $text = 'Registration failed';
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <?php include(ROOT . '/core/templates/nav.php'); ?>
</header>

<main>
    <h2 class="tittle">REGISTRACIJA</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <p><?php if (isset($text)) print $text; ?></p>
</main>
</body>
</html>

