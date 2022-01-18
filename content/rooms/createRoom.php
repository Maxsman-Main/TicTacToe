<?php
    session_start();

    include "../database/connect.php";

    function add_room($conn, $player){
        $sql = "INSERT INTO `games` (`owner`, `current_player`, `status`) VALUES ('$player', 0, 0)";
        $conn->query($sql);
        $sql = "SELECT `game_id` FROM `games` WHERE `owner` = '$player'";
        $row = $conn->query($sql);
        $result = $row->fetch_assoc();
        $_SESSION["activeGame"] = $result["game_id"];
    }

    add_room($conn, $_SESSION["login"]);
    header("Location: ../game/game.php");
?>