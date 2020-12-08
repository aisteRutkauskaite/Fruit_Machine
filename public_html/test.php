<?php


use App\App;


use Core\test\Test;
use Core\test\VendingMachine;

require '../bootloader.php';

$item = new Test('Coca-Cola', 'A04', 0, 1.1);
var_dump($item);

var_dump($item->getName());
var_dump($item->getCode());
var_dump($item->getQuantity());
var_dump($item->getPrice());

$items = [
    new Test('Coca-Cola', 'A04', 0, 1.1),
    new Test('Sprite', 'A06', 1, 1.5),
    new Test('Fanta', 'B06', 2, 1.3),
    new Test('Pepsi', 'B08', 5, 1.3),
    new Test('Just-cola', 'B09', 10, 1.1),
    new Test('Nestea', 'C02', 4, 0.9),
    new Test('7up', 'C05', 9, 0.9),
    new Test('Corona', 'D08', 3, 2.5),
    new Test('Schweppes', 'D09', 5, 1.6),
    new Test('Vytautas', 'E01', 4, 1.2),
];

//var_dump($items );

$vendingMachine = new VendingMachine($items);

$products = $vendingMachine->makeArray();


$products = $vendingMachine->getData();

//$code = $vendingMachine->itemExist('B08');
//$code = $vendingMachine->vend('B08');
//var_dump($code);



$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'product_code' => [
            'label' => 'Produkto kodas',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'kodas',
                    'class' => 'input-field',
                ],
            ],
        ],
        'money' => [
            'label' => 'Pinigų suma',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Suma',
                    'class' => 'input-field',
                ],
            ],
        ],
    ],

    'buttons' => [
        'send' => [
            'title' => 'Patikrinti',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
    'validators' => [
            ]
];


if (isset($_POST)) {
    var_dump($_POST);
    $text = $vendingMachine->vend($_POST['product_code'], $_POST['money']);

}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="">

<main>
    <section class="section">
        <?php foreach ($vendingMachine->getData() as $index => $product): ?>
            <div class="container">
                <span> Name:<?php print $product->getName(); ?></span>
                <span>Code:<?php print $product->getCode(); ?></span>
                <span>Quantity:<?php print $product-> getQuantity(); ?></span>
                <span>Price:<?php print $product-> getPrice(); ?></span>
            </div>
        <?php endforeach; ?>
    </section>
    <section>
        <?php require ROOT . '/core/templates/form.tpl.php'; ?>
        <?php if(isset($_POST)): ?>
        <span><?php print $text; ?></span>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
