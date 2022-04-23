<?php
require_once dirname(__FILE__) . '/../../../config.php';
include_once DIR_ROOT . 'view/layout/head.php';
include_once DIR_ROOT . 'view/layout/header.php';
include_once DIR_ROOT . 'view/layout/navbar.php';
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET['op']) || $_GET['op'] == 'read'){
        include_once DIR_ROOT . 'view/pages/users/read.php';
    }
    else if ($_GET['op'] == 'update') {
        include_once DIR_ROOT . 'view/pages/users/update.php';
    }
    else if ($_GET['op'] == 'change_password') {
        $error = '';
        include_once DIR_ROOT . 'view/pages/users/change_password.php';
    }
    else{
        header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/users.php');
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_GET['op']) || $_GET['op'] == 'update'){
        $updated_user = UserController->update(
            current_user['id'],
            UserController->check_input($_POST["firstname"]),
            UserController->check_input($_POST["lastname"]),
            UserController->check_input($_POST["birthdate"]),
            UserController->check_input($_POST["phone"])
        );
        header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/users.php');
    }
    else if ($_GET["op"] == 'change_password'){
        [
            "old" => $old,
            "new" => $new,
            "new_again" => $new_again,
        ] = $_POST;
        if ($new !== $new_again){
            $error = "Please retype your new password";
            include_once DIR_ROOT . 'view/pages/users/change_password.php';
            return;
        }
        if ($old !== current_user['password']){
            $error = "Please retype your old password";
            include_once DIR_ROOT . 'view/pages/users/change_password.php';
            return;
        }
        $regex = "/^[a-zA-Z0-9_\-!@#$%^&*().]{8,50}$/";
        if (preg_match($regex, $new) === 0) {
            $error = "Password min length is 8 and max length is 50";
            include_once DIR_ROOT . 'view/pages/users/change_password.php';
            return;
        }
        UserController->change_password(current_user['id'], $new);
        header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/users.php');
    }
    else {
        header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/users.php');
    }
}
else {
    include_once DIR_ROOT . 'view/pages/users/read.php';
}
?>

<?php include_once DIR_ROOT . 'view/layout/footer.php'; ?>