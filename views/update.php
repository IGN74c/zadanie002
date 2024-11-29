<?php
require './model/functions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    update_user($_SESSION['user_id'], $_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновление данных</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <?php require "views\components\header.php" ?>

    <section>
        <h1 class="mb20">Обновление данных</h1>
        <form method="post" class="form-center">
            <input type="text" name="username" placeholder="Новое имя пользователя" required autocomplete="off">
            <input type="password" name="password" placeholder="Новый пароль (если нужно)" autocomplete="off">
            <button type="submit">Обновить</button>
        </form>
    </section>

</body>

</html>