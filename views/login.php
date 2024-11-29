<?php
require './model/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = get_user($_POST['username_or_email'], $_POST['password']);
    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: /');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <header>
        <a href="/">Главная</a>
        <a href="/views/login.php">Авторизация</a>
        <a href="/views/register.php">Регистрация</a>
    </header>
    <section>
        <h1 class="mb20">Вход</h1>
        <form method="post" class="form-center">
            <input type="text" name="username_or_email" placeholder="Имя пользователя или Email" required
                autocomplete="off">
            <input type="password" name="password" placeholder="Пароль" required autocomplete="off">
            <button type="submit">Войти</button>
            <a href="/views/reset_password.php">Восстановление пароля</a>
        </form>
    </section>

</body>

</html>