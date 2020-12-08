<?php

use App\App;


require '../bootloader.php';
$message = 'Žaidžiam :)';


if (isset($_POST['game'])) {

    if (!App::$session->getUser()) {
        header('Location: login.php');
    }
    $file = file_to_array(DB_FILE);
    foreach ($file['users'] as $index => $user) {
        if ($user['user_name'] === $_SESSION['user_name']) {
            $row = App::$db->getRowWhere('users', ['user_name' => $_SESSION['user_name']]);
            $random_numbers = [rand(0, 2), rand(0, 2), rand(0, 2)];
            if (count(array_count_values($random_numbers)) == 1) {
                $row['cash'] += 1000;
                $row['activity'] = ['veikla'=> 'win','laimejimas' => 1000, 'date' => date('Y-m-d')];
                App::$db->updateRow('users', $index, $row);
                $message = 'Jūs laimėjote 1000 pinigų';
            } elseif ($random_numbers[0] === $random_numbers[1] || $random_numbers[0] === $random_numbers[2] || $random_numbers[1] === $random_numbers[2]) {
                $row['cash'] += 500;
                $row['activity'] = ['veikla'=> 'win','laimejimas' => 500, 'date' => date('Y-m-d')];
                App::$db->updateRow('users', $index, $row);
                $message = 'Jūs laimėjote 500 pinigų';
            } elseif ($row['cash'] > 100) {
                $row['cash'] -= 100;
                $row['activity'] = ['veikla'=> 'lose', 'pralaimejo' => 100, 'date' => date('Y-m-d')];
                App::$db->updateRow('users', $index, $row);
                $message = 'Jūs pralaimėjote 100 pinigų';
            } else {
                $message = 'Jums trūksta pinigų';
                header('Location: /admin/buy.php');
            }
        }
    }
}
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
    <h1 class="tittle"><?php print $message ?></h1>
    <section class="game_section">
        <?php if (isset($_POST['game'])): ?>
        <div class="game_pictures">
            <?php foreach ($random_numbers as $index => $number): ?>
                <div class=" image img<?php print $number; ?>"></div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <form action="" method="post">
            <button class="game_button" name="game" type="submit">Žaisti</button>
        </form>
    </section>
</main>
</body>
</html>

