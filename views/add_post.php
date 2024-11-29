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
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <?php require "views\components\header.php" ?>

    <h1 class="text-center">Добавить пост</h1>
    <section>
        <form method="post" class="form-center">
            <input type="text" name="title" placeholder="Название" autocomplete="off">
            <input type="text" name="content" placeholder="Содержание" autocomplete="off">
            <button type="submit">Создать пост</button>
        </form>
    </section>
</body>

</html>