<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <?php
        include "../header.php";
    ?>

    <div class="content flex" style="flex-direction: column;">
        <form method="POST"action="doLogin.php" class="form flex" style="flex-direction: column">
            <label for="">Логин</label>
            <input type="text" name="login">

            <label for="">Пароль</label>
            <input type="password" name="password">

            <input type="submit" value="Войти" id="submit">
        </form>
        <a href="../registration/reg.php" id="toOtherDecision">Зарегистрироваться</a>
    </div>
</body>
</html>