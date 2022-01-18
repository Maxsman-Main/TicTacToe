<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leader Board</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <?php
        include 'header.php';
        include './database/connect.php';
    
        function get_users($conn){
            $sql = "SELECT `login` FROM `users` ORDER BY `wins` DESC";
            $result = $conn->query($sql);
            return $result;
        }


        function get_wins($conn){
            $sql = "SELECT `wins` FROM `users` ORDER BY `wins` DESC";
            $result = $conn->query($sql);
            return $result;
        }

        
        function get_loses($conn){
            $sql = "SELECT `loses` FROM `users` ORDER BY `wins` DESC";
            $result = $conn->query($sql);
            return $result;
        }

        $users = get_users($conn);
        
        $wins = get_wins($conn);

        $loses = get_loses($conn);

    ?>

    <div class="content flex">
        <div class="leaderboard flex">
            <div class="name">
                <label for="">Игрок</label>
                <ul>
                    <?php
                        for($i = 0; $i < 5; $i++){
                            echo("<li>".$users->fetch_assoc()["login"]."</li>");
                        }
                    ?>
                </ul>
            </div>

            <div class="wins">
                <label for="">Победы</label>
                <ul>
                    <?php
                        for($i = 0; $i < 5; $i++){
                            echo("<li>".$wins->fetch_assoc()["wins"]."</li>");
                        }
                    ?>
                </ul>
            </div>

            <div class="loses">
                <label for="">Поражения</label>
                <ul>
                    <?php
                        for($i = 0; $i < 5; $i++){
                            echo("<li>".$loses->fetch_assoc()["loses"]."</li>");
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>