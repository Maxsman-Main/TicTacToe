<?php 
    session_start();

    include './content/database/connect.php';

    function check_player($conn, $name){
        $sql = "SELECT * FROM `games` WHERE `player` = '$name'";
        $result = $conn->query($sql);
        if($result != null){
            $_SESSION["activeGame"] = $result->fetch_assoc()["game_id"];
        }
    }

    function check_owner($conn, $name){
        $sql = "SELECT * FROM `games` WHERE `owner` = '$name'";
        $result = $conn->query($sql);
        if($result != null){
            $_SESSION["activeGame"] = $result->fetch_assoc()["game_id"];
        }
    }

    
    check_owner($conn, $_SESSION["login"]);
    if($_SESSION["activeGame"] == NULL){
        check_player($conn, $_SESSION["login"]);
    }    
?>