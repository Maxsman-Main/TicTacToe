<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TIC TAC TOE</title>
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<div class="game" id="game"></div>
<div class="game" id="status"></div>
<script>
    function show(){
        $.ajax({
            url: "gameField.php",
            success: function(html){
                $("#game").html(html);
            }
        });
    }

    function winChack(){
        $.ajax({
            url: "winChacker.php",
            success: function(html){
                $("#status").html(html);
            }
        });
    }

    $(document).ready(function(){
        show();
        setInterval('show()', 1000);
        setInterval('winChack()', 1000);
    });
</script>
</body>
</html>