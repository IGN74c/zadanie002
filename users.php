<?php
require './model/functions.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$db = connect_database();
$result = $db->query("SELECT id, username, email, role, created_at FROM users");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
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

    <h1>Список пользователей</h1>
    <div class="users">
        <?php while ($user = $result->fetch_assoc()) { ?>
            <div class="user">
                <h3>Айди: <?= $user['id'] ?></h3>
                <p>Имя: <?= $user['username'] ?></p>
                <p>Почта: <?= $user['email'] ?></p>
                <p>Роль: <?= $user['role'] ?></p>
                <p>Зарегистрировался: <?= $user['created_at'] ?></p>
            </div class="user">
        <?php } ?>
    </div class="users">

</body>

</html>