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
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <?php require "views\components\header.php" ?>

    <h1 class="text-center">Список пользователей</h1>
    <div class="posts">
        <?php while ($user = $result->fetch_assoc()) { ?>
            <div class="post">
                <h3>Айди: <?= $user['id'] ?></h3>
                <p>Имя: <?= $user['username'] ?></p>
                <p>Почта: <?= $user['email'] ?></p>
                <p>Роль: <?= $user['role'] ?></p>
                <p>Зарегистрировался: <?= $user['created_at'] ?></p>
            </div>
        <?php } ?>
    </div>

</body>

</html>