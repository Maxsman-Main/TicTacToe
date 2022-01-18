<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $db = "tictactoe";
    $conn = mysqli_connect($servername, $username, $password, $db);
    $conn -> set_charset("utf8");
?>