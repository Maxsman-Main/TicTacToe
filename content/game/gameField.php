<?php
    session_start();

    include '../database/connect.php';

    function get_game_info($conn, $game_id){
        $sql = "SELECT * FROM `games` WHERE `game_id` = '$game_id'";
        $row = $conn->query($sql);
        return $row->fetch_assoc();
    }

    $info = get_game_info($conn, $_SESSION["activeGame"]);    
?>
<div class="board" id="board">
    <div>
        <div class="cell" id="cell1"><?php echo($info["cell1"]);?></div>
        <div class="cell" id="cell4"><?php echo($info["cell4"]);?></div>
        <div class="cell" id="cell7"><?php echo($info["cell7"]);?></div>
    </div>
    <div>
        <div class="cell" id="cell2"><?php echo($info["cell2"]);?></div>
        <div class="cell" id="cell5"><?php echo($info["cell5"]);?></div>
        <div class="cell" id="cell8"><?php echo($info["cell8"]);?></div>
    </div>
    <div>
        <div class="cell" id="cell3"><?php echo($info["cell3"]);?></div>
        <div class="cell" id="cell6"><?php echo($info["cell6"]);?></div>
        <div class="cell" id="cell9"><?php echo($info["cell9"]);?></div>
    </div>
</div>
<?php
    if($info["owner"] != NULL){
        echo("Игрок 1: ".$info["owner"]."<br>");
        echo("Игрок 2: ".$info["player"]."<br>"); 
        if($info["player"] != NULL && $info["status"] == 0){
            echo("Ходит игрок номер - ".$info["current_player"]."<br>");
        }
        if($info["status"] != 0){
            if($info["status"] != -1){
                echo("Победитель игрок номер - ".$info["status"]);
            }
            else{
                echo("Ничья!");
            }
        }
    }
    else{
        echo("Комната была закрыта создателем<br>");
    }
    echo("<a style='text-decoration:none; color:black;' href='outGame.php'>Покинуть комнату</a>");
?>

<script>
    $(document).ready(function(){
        
        $('#cell1').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell1',
            });
        });

        $('#cell2').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell2',
            });
        });

        $('#cell3').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell3',
            });
        });

        $('#cell4').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell4',
            });
        });

        $('#cell5').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell5',
            });
        });

        $('#cell6').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell6',
            });
        });

        $('#cell7').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell7',
            });
        });

        $('#cell8').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell8',
            });
        });

        $('#cell9').click(function(){
            $.ajax({
                type: "POST",
                url:'makeMove.php',
                data: 'cell=cell9',
            });
        });
    });
</script>