<?php

use App\App;

require '../bootloader.php';

$items = App::$db->getRowsWhere('items');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="index__body">
<?php include(ROOT . '/core/templates/nav.php'); ?>
<main>
    <h1>WELCOME TO BBZ SHOP!</h1>
    <section class="product__section">
        <?php foreach ($items as $item): ?>
            <div>
                <img src="<?php print $item['image']; ?>" alt="item image">
                <div>
                    <h3><?php print $item['name']; ?></h3>
                    <p><?php print $item['price']; ?> EUR</p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>

