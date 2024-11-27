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
</head>

<body>

<header>
        <a href="/">Главная</a>
        <a href="/update.php">Обновить данные</a>
        <a href="/update.php">Добавиить пост</a>
        <a href="/update.php">Все посты</a>
        <?php if ($_SESSION['role'] === 'admin') { ?>
            <a href="users.php">Список пользователей</a>
        <?php } ?>
    </header>
    <h1>Список постов</h1>
    <div class="posts">
        <?php foreach ($result as $value) { ?>
            <h1>Название: <?= $value['title'] ?></h1>
            <p>Автор: <?= $value['username'] ?></p>
            <p>Содержание: <?= $value['content'] ?></p>
        <?php } ?>
    </div>

</body>

</html>