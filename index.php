<?php
    session_start();

    if($_SESSION["login"] != NULL){
        include 'checkPlayer.php';
        if($_SESSION["activeGame"] != NULL){
            header("Location: ./content/game/game.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TIC TAC TOE</title>
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="./content/game/jquery.js"></script>
</head>
<body>

    <?php
        include "./content/header.php";
    ?>

    <div class="content flex" id="content">
        <div class="menu">
            <?php if($_SESSION["login"] != NULL){ ?>
                <button class="createRoom" onclick="window.location.href = './content/rooms/createRoom.php'">Создать комнату</button>
            <?php } ?>
            <div id="rooms"></div>
        </div>
    </div>
</body>
<script>
    function show(){
        $.ajax({
            url: "./content/rooms/rooms.php",
            success: function(html){
                $("#rooms").html(html);
            }
        });
    }

    $(document).ready(function(){
        show();
        setInterval('show()', 1000);
    });
</script>
</html>