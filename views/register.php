<?php
require './model/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    create_user($_POST['username'], $_POST['email'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <header>
        <a href="/">Главная</a>
        <a href="/views/login.php">Авторизация</a>
        <a href="/views/register.php">Регистрация</a>
    </header>
    <section>
        <h1 class="mb20">Регистрация</h1>
        <form method="post" class="form-center">
            <input type="text" name="username" placeholder="Имя пользователя" required autocomplete="off">
            <input type="email" name="email" placeholder="Email" required autocomplete="off">
            <input type="password" name="password" placeholder="Пароль" required autocomplete="off">
            <button type="submit">Зарегистрироваться</button>
        </form>
    </section>

</body>

</html>