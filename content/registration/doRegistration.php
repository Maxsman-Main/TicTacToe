<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["login"] == NULL){
            header("Location: index.php");
        }

        include "../database/connect.php";

        function check_user_login($login, $conn){
            $sql = "SELECT `login` FROM `users` WHERE `login` = '$login'";
            $result = $conn->query($sql);
            $value = $result->fetch_assoc();
            
            if($value)
                return true;

            return false;
        }

        function add_new_user($login, $password, $conn){
            if(check_user_login($login, $conn) == true){
                header("Location: reg.php");
            }
            else{
                $date = date('Y-m-d');
                $sql = "INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')";
                $conn->query($sql);
                $_SESSION["login"] = $login;
                header("Location: /index.php");
            }
        }

        $login = $_POST["login"];
        $password = $_POST["password"];
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        add_new_user($login, $hashpassword, $conn);
    }
    else{
        header("Location: index.php");
    }
?>