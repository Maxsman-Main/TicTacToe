<?php
    session_start();

    include '../database/connect.php';

    function get_game_info($conn, $game_id){
        $sql = "SELECT * FROM `games` WHERE `game_id` = '$game_id'";
        $row = $conn->query($sql);
        return $row->fetch_assoc();
    }

    function check_rows($info){
        if($info["cell1"] == $info["cell2"] && $info["cell2"] == $info["cell3"] && $info["cell1"] != NULL){
            return $info["cell1"];
        }
        if($info["cell4"] == $info["cell5"] && $info["cell5"] == $info["cell6"] && $info["cell4"] != NULL){
            return $info["cell4"];
        }
        if($info["cell7"] == $info["cell8"] && $info["cell8"] == $info["cell9"] && $info["cell7"] != NULL){
            return $info["cell7"];
        }
        return NULL;
    }

    function check_cols($info){
        if($info["cell1"] == $info["cell4"] && $info["cell4"] == $info["cell7"] && $info["cell1"] != NULL){
            return $info["cell1"];
        }
        if($info["cell2"] == $info["cell5"] && $info["cell5"] == $info["cell8"] && $info["cell2"] != NULL){
            return $info["cell2"];
        }
        if($info["cell3"] == $info["cell6"] && $info["cell6"] == $info["cell9"] && $info["cell3"] != NULL){
            return $info["cell3"];
        }
        return NULL;
    }

    function check_angles($info){
        if($info["cell1"] == $info["cell5"] && $info["cell5"] == $info["cell9"] && $info["cell1"] != NULL){
            return $info["cell1"];
        }
        if($info["cell3"] == $info["cell5"] && $info["cell5"] == $info["cell7"] && $info["cell3"] != NULL){
            return $info["cell3"];
        }
        return NULL;
    }

    function update_game_status($conn, $game_id, $winner){
        if($winner == "X"){
            $sql = "UPDATE `games` SET `status` = 1 WHERE `game_id` = '$game_id'";
        }
        if($winner == "O"){
            $sql = "UPDATE `games` SET `status` = 2 WHERE `game_id` = '$game_id'";    
        }
        $conn->query($sql);
    }

    function update_users($conn, $winner, $owner, $player){
        if($winner == "X"){
            echo(1);
            $sql = "UPDATE `users` SET `wins` = `wins` + 1 WHERE `login` = '$owner'";
            $conn->query($sql);
            $sql = "UPDATE `users` SET `loses` = `loses` + 1 WHERE `login` = '$player'";
            $conn->query($sql);
        }
        else{
            $sql = "UPDATE `users` SET `loses` = `loses` + 1 WHERE `login` = '$owner'";
            $conn->query($sql);
            $sql = "UPDATE `users` SET `wins` = `wins` + 1 WHERE `login` = '$player'";
            $conn->query($sql);
        }
    }

    $info = get_game_info($conn, $_SESSION["activeGame"]);
    
    if($info["status"] == 0){
        $rows = check_rows($info);
        $cols = check_cols($info);
        $angles = check_angles($info);
        if($rows != NULL){
            update_game_status($conn, $_SESSION["activeGame"], $rows);
            update_users($conn, $rows, $info["owner"], $info["player"]);
        }
        if($cols != NULL){
            update_game_status($conn, $_SESSION["activeGame"], $cols);
            update_users($conn, $cols, $info["owner"], $info["player"]);
        }
        if($angles != NULL){
            update_game_status($conn, $_SESSION["activeGame"], $angles);
            update_users($conn, $angles, $info["owner"], $info["player"]);
        }
    }
?>
