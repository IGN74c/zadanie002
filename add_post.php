<?php
require './model/functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    create_post($_SESSION['user_id'], $_POST['title'], $_POST['content']);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить пост</title>
</head>

<body>

    <header>
        <a href="/">Главная</a>
        <a href="/update.php">Обновить данные</a>
        <a href="/update.php">Добавиить пост</a>
        <a href="/update.php">Все посты</a>
    </header>

    <h1>Регистрация</h1>
    <form method="post">
        <input type="text" name="title" placeholder="Название" autocomplete="off">
        <input type="text" name="content" placeholder="Содержание" autocomplete="off">
        <button type="submit">Создать пост</button>
    </form>

</body>

</html>