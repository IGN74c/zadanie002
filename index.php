<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
</head>

<body>

    <header>
        <a href="/">Главная</a>
        <a href="/login.php">Авторизация</a>
        <a href="/register.php">Регистрация</a>
        <a href="/update.php">Обновить данные</a>
        <?php if ($_SESSION['role'] === 'admin') { ?>
            <a href="users.php">Список пользователей</a>
        <?php } ?>
    </header>

    <h1>Добро пожаловать, <?= $_SESSION['username'] ?>!</h1>
    <p>Ваша роль: <?= $_SESSION['role'] ?></p>

    <form method="post">
        <button>Выйти</button>
    </form>

</body>

</html>