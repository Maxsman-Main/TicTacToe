<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["login"] == NULL){
            header("Location: /index.php");
        }

        include "../database/connect.php";

        function check_user_data($login, $pass, $conn){
            $sql = "SELECT `password` FROM `users` WHERE `login` = '$login'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $hashpass = $row['password'];
            if(password_verify($pass, $hashpass)){
                return true;
            }
            else{
                return false;
            }
        }

        $login = $_POST["login"];
        $password = $_POST["password"];
        
        check_user_data($login, $password, $conn);
        
        if(check_user_data($login, $password, $conn) == true){
            $_SESSION["login"] = $login;
            header("Location: /index.php");
        }
        else{
            header("Location: login.php");
        }
    }
    else{
        header("Location: /index.php");
    }
?>