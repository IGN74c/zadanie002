<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /views/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    session_unset();
    session_destroy();
    header('Location: /views/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <?php require "views\components\header.php" ?>

    <section>
        <div class="content">
            <h1>Добро пожаловать, <?= $_SESSION['username'] ?>!</h1>
            <p>Ваша роль: <?= $_SESSION['role'] ?></p>
            <form method="post">
                <button>Выйти</button>
            </form>
        </div>
    </section>


</body>

</html>