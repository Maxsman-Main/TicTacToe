<header>
    <h1 onclick="location.href = '/index.php'">TIC-TAC-TOE</h1>
    <a href="/content/leaderboard.php">Таблица лидеров</a>
    <?php if($_SESSION["login"] == null){?>
        <a href="/content/registration/reg.php">Регистрация</a>
    <?php } else{ ?>
        <a href="/content/out.php">Выйти</a>
     <?php } ?>
</header>
