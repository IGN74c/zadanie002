<?php
require './model/functions.php';
date_default_timezone_set('Asia/Yekaterinburg');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = connect_database();

    if ($_POST['type'] === 'reset') {
        $user_data = reset_password($_POST['username_or_email']);
        if ($user_data) {
            echo "Токен для восстановления отправлен. Код: {$user_data['token']}";
        } else {
            echo "Пользователь не найден.";
        }
    } elseif ($_POST['type'] === 'token') {
        $token = $_POST['token'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $stmt = $db->prepare("SELECT * FROM password_reset_tokens WHERE token = ? AND expired_at > NOW()");
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $reset_data = $result->fetch_assoc();

        if ($reset_data) {
            $user_id = $reset_data['user_id'];

            $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param('si', $new_password, $user_id);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM password_reset_tokens WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();

            echo "Пароль успешно обновлён.";
        } else {
            echo "Неверный или истёкший токен.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Восстановление пароля</title>
</head>

<body>
    <header>
        <a href="/">Главная</a>
        <a href="/login.php">Авторизация</a>
        <a href="/register.php">Регистрация</a>
    </header>

    <h1>Восстановление пароля</h1>
    <form method="post">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'reset') { ?>
            <input type="text" name="token" placeholder="Код для восстановления" required autocomplete="off">
            <input type="password" name="new_password" placeholder="Новый пароль" required autocomplete="off">
            <button name="type" type="submit" value="token">Отправить</button>
        <?php } else { ?>
            <input type="text" name="username_or_email" placeholder="Имя пользователя или Email" required
                autocomplete="off">
            <button name="type" type="submit" value="reset">Восстановить пароль</button>
        <?php } ?>
    </form>
</body>

</html>