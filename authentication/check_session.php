<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: http://localhost/pwa/zapoctova_prace/login.php");
    exit();
}

include dirname(__DIR__) . "../model/User.php";
$User = new User();
$user = $User->get_from_username($_SESSION["username"]);
define("current_user", $user);
define("UserController", $User);
?>