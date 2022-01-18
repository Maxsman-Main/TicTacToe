<?php
    session_start();

    include "../database/connect.php";

    function join_game_database($conn, $player, $id){
        $sql = "UPDATE `games` SET `player` = '$player' WHERE `game_id` = '$id'";
        $conn->query($sql);
        $first = rand(1, 2);
        $sql = "UPDATE `games` SET `current_player` = '$first' WHERE `game_id` = '$id'";
        $conn->query($sql);
    }

    join_game_database($conn, $_SESSION["login"], $_POST["gameID"]);
    $_SESSION["activeGame"] = $_POST["gameID"];
    header("Location: ./game.php");
?>