<?php
require './model/functions.php';
session_start();

$db = connect_database();
$result = get_posts();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список постов</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <?php require "views\components\header.php" ?>

    <h1 class="text-center">Список постов</h1>
    <div class="posts">
        <?php foreach ($result as $value) { ?>
            <div class="post">
                <h1>Название: <?= $value['title'] ?></h1>
                <p>Автор: <?= $value['username'] ?></p>
                <p>Содержание: <?= $value['content'] ?></p>
            </div>
        <?php } ?>
    </div>

</body>

</html>