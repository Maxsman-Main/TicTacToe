<?php
    session_start();

    include '../database/connect.php';

    function get_game_info($conn, $game_id){
        $sql = "SELECT * FROM `games` WHERE `game_id` = '$game_id'";
        $row = $conn->query($sql);
        return $row->fetch_assoc();
    }

    function update_info_x($conn, $game_id, $cell){
        $sql = "UPDATE `games` SET `$cell` = 'X' WHERE `game_id` = '$game_id'";
        $conn->query($sql);
    }

    function update_info_y($conn, $game_id, $cell){
        $sql = "UPDATE `games` SET `$cell` = 'O' WHERE `game_id` = '$game_id'";
        $conn->query($sql);
    }

    function change_current_player($conn, $game_id, $player){
        if($player == 1){
            $sql = "UPDATE `games` SET `current_player` = '2' WHERE `game_id` = '$game_id'";
            $conn->query($sql);
        }
        else{
            $sql = "UPDATE `games` SET `current_player` = '1' WHERE `game_id` = '$game_id'";
            $conn->query($sql);
        }
    }

    $info = get_game_info($conn, $_SESSION["activeGame"]);

    if($info["status"] == 0){
        if($info[$_POST["cell"]] == NULL){
            if($_SESSION["login"] == $info["owner"] && $info["current_player"] == 1){ 
                update_info_x($conn, $_SESSION["activeGame"], $_POST["cell"]);
                change_current_player($conn, $_SESSION["activeGame"], $info["current_player"]);    
            }
            else if($_SESSION["login"] == $info["player"] && $info["current_player"] == 2){
                update_info_y($conn, $_SESSION["activeGame"], $_POST["cell"]);
                change_current_player($conn, $_SESSION["activeGame"], $info["current_player"]);    
            }
        }
    }
    //header("Location: ./game.php");
?>