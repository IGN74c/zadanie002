<?php
function connect_database()
{
    $hostname = '151.248.115.10';
    $username = 'root';
    $password = 'Kwuy1mSu4Y';
    $database = 'learn_rahmonov';

    $db = new mysqli(
        $hostname,
        $username,
        $password,
        $database
    );

    if ($db->connect_error) {
        die('Ошибка');
    }
    return $db;
}

function create_user($username, $email, $password)
{
    $db = connect_database();

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->fetch_assoc()) {
        echo "<script>alert('такой пользователь уже есть')</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('пользователь зарегистрирован')</script>";
        } else {
            echo "<script>alert('ошибка регистрации')</script>";
        }
    }
}

function get_user($username_or_email, $password)
{
    $db = connect_database();

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param('ss', $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        echo "<script>alert('успешно')</script>";
        return $user;
    } else {
        echo "<script>alert('неверный логин или пароль')</script>";
    }
}

function update_user($user_id, $new_username, $new_password = null)
{
    $db = connect_database();

    $hashed_password = null;
    if ($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    }

    if ($hashed_password) {
        $stmt = $db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param('ssi', $new_username, $hashed_password, $user_id);
    } else {
        $stmt = $db->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->bind_param('si', $new_username, $user_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('обновлено')</script>";
    } else {
        echo "<script>alert('ошибка')</script>";
    }
}

function create_post($user_id, $title, $content)
{
    $db = connect_database();

    $stmt = $db->prepare(query: "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $user_id, $title, $content);
    $stmt->execute();
}

function get_posts()
{
    $db = connect_database();

    $stmt = $db->query(query: "SELECT users.username, posts.title, posts.content FROM posts INNER JOIN users ON posts.user_id = users.id");
    $result = $stmt->fetch_all(MYSQLI_ASSOC);

    return $result;
}

function reset_password($username_or_email)
{
    $db = connect_database();

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param('ss', $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $id = $user['id'];
        $token = bin2hex(random_bytes(16));
        $expired = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $db->prepare("DELETE FROM password_reset_tokens WHERE user_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $stmt = $db->prepare("INSERT INTO password_reset_tokens (user_id, token, expired_at) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $id, $token, $expired);
        $stmt->execute();

        return ['id' => $id, 'token' => $token];
    } else {
        return null;
    }
}