<?php
    session_start();
    
    include '../database/connect.php';

    function get_game_info($conn, $game_id){
        $sql = "SELECT * FROM `games` WHERE `game_id` = '$game_id'";
        $row = $conn->query($sql);
        return $row->fetch_assoc();
    }

    function clear_board($conn, $game_id){
        $sql = "UPDATE `games` SET `cell1` = NULL,
                                    cell2  = NULL,
                                    cell3  = NULL,
                                    cell4  = NULL,
                                    cell5  = NULL,
                                    cell6  = NULL,
                                    cell7  = NULL,
                                    cell8  = NULL,
                                    cell9  = NULL
                                    WHERE `game_id` = '$game_id'";
        $conn->query($sql);
        $sql = "UPDATE `games` SET `status` = 0 WHERE `game_id` = '$game_id'";
        $conn->query($sql);
        $sql = "UPDATE `games` SET `player` = NULL WHERE `game_id` = '$game_id'";
        $conn->query($sql);
        $sql = "UPDATE `games` SET `current_player` = 0 WHERE `game_id` = '$game_id'";
        $conn->query($sql);
    }

    function delete_room($conn, $game_id){
        $sql = "DELETE FROM `games` WHERE `game_id` = '$game_id'";
        $conn->query($sql);
    }

    $info = get_game_info($conn, $_SESSION["activeGame"]);    

    if($_SESSION["login"] == $info["player"]){
        clear_board($conn, $_SESSION["activeGame"]);
        $_SESSION["activeGame"] = NULL;
    }
    if($_SESSION["login"] == $info["owner"]){
        delete_room($conn, $_SESSION["activeGame"]);
        $_SESSION["activeGame"] = NULL;
    }
    header("Location: /index.php");
?>