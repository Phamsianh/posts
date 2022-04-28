<?php
session_start();
require_once dirname(__FILE__) . '/../config.php';
if (!isset($_SESSION["username"])) {
    header("Location: " . ROOT_PATH ."/login.php");
    exit();
}

include dirname(__DIR__) . "../model/User.php";
$User = new User();
$user = $User->get_from_username($_SESSION["username"]);
define("current_user", $user);
define("UserController", $User);
?>