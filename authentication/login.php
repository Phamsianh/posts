<?php
require_once dirname(__FILE__) . '/../config.php';
include_once DIR_ROOT . "model/User.php";
$User = new User();

$error_username = "";
$error_password = "";

if (!empty($_POST)) {
    if (empty($_POST["username"])) {
        $error_username = "username must be filled <br>";    
    }else{
        $username = $_POST["username"];
        $password = $_POST["password"];
        $user = $User->get_from_username($username);

        if (!$user) {
            $error_username = "username not found <br>";
        } 
        else if (!$_POST["password"]) {
            $error_password = "password must be filled <br>";
        } 
        else if ($user["password"] == $_POST["password"]) {
            $login = true;
            session_start();
            $_SESSION["username"] = $user["username"];
            header("Location: " . ROOT_PATH . "/users.php");
        } 
        else {
            $login = false;
        }
    }  
}

?>