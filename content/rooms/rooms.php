<?php

    session_start();

    include "../database/connect.php";

    function rooms_count($conn){
        $sql = "SELECT * FROM `games`";
        return $conn->query($sql);
    }

    $result = rooms_count($conn);
?>
<label>Доступные комнаты:</label>
<ul id="rooms">
    <?php 
        while($row = $result->fetch_assoc()){
            if($row["player"] == NULL){
                echo("  
                        <p>Номер игры: ".$row["game_id"]."<p>
                        <p>Комната игрока: ".$row["owner"]."<p>
                    ");
                if($_SESSION["login"] != NULL){
                    echo("<form method='POST' action='/content/game/joinGame.php'>
                                <input type='hidden' name='gameID' value=".$row["game_id"].">
                                <input class='joinRoom' type='submit' value='Присоединится'>
                          </form>");
                }
            }
        }
    ?>
</ul>