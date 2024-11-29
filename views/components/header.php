<header>
    <a href="/" class="header-link">
        Блог Ру
    </a>
    <nav>
        <a href="/">Главная</a>
        <?php if (!$_SESSION['role']) { ?>
            <a href="/views/login.php">Авторизация</a>
            <a href="/views/register.php">Регистрация</a>
        <?php } else { ?>
            <a href="/views/update.php">Обновить данные</a>
        <?php } ?>
        <a href="/views/add_post.php">Добавить пост</a>
        <a href="/views/view_posts.php">Все посты</a>
        <?php if ($_SESSION['role'] === 'admin') { ?>
            <a href="/views/users.php">Список пользователей</a>
        <?php } ?>
    </nav>
</header>