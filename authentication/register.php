<?php 
$errors = [
    "username" => "",
    "password" => "",
    "firstname" => "",
    "lastname" => "",
    "birthdate" => "",
    "phone" => ""
];

if (empty($_POST)) {
    return;
}
[
    "username" => $username,
    "password" => $password,
    "firstname" => $firstname,
    "lastname" => $lastname,
    "birthdate" => $birthdate,
    "phone" => $phone
] = $_POST;

function check_username()
{
    global $username, $errors;
    if (!isset($username)) {
        $errors["username"] = "User name is required";
        return false;
    }
    $regex = "/^[a-zA-Z0-9\-_]{1,50}$/";
    if (preg_match($regex, $username) === 0) {
        $errors["username"] = "User name max length is 50, and must contain only alphanumerical character, underscore '_' or hyphen '-'";
        return false;
    }
    return true;
}

function check_password() {
    global $password, $errors;
    if (empty($password)) {
        $errors["password"] = "Password is required";
        return false;
    }
    $regex = "/^[a-zA-Z0-9_\-!@#$%^&*().]{8,50}$/";
    if (preg_match($regex, $password) === 0) {
        $errors["password"] = "Password min length is 8 and max length is 50";
        return false;
    }
    return true;
}

function check_firstname () {
    global $firstname, $errors;
    if (empty($firstname)) {
        $errors["firstname"] = "First name is required";
        return false;
    }
    $regex = "/^[a-zA-Z\s]{1,50}$/";
    if (preg_match($regex, $firstname) === 0) {
        $errors["firstname"] = "First name only contain word and white space";
        return false;
    }
    return true;
}

function check_lastname () {
    global $lastname, $errors;
    if (empty($lastname)) {
        $errors["lastname"] = "Last name is required";
        return false;
    }
    $regex = "/^[a-zA-Z\s]{1,50}$/";
    if (preg_match($regex, $lastname) === 0) {
        $errors["lastname"] = "Last name only contain word and white space";
        return false;
    }
    return true;
}

function check_birthdate() {
    global $birthdate, $errors;
    if (empty($birthdate)) {
        return true;
    }
    $test_birthdate  = explode('/', $birthdate);
    if (!checkdate($test_birthdate[0], $test_birthdate[1], $test_birthdate[2])) {
        $errors["birthdate"] = "Birthdate is not valid";
        return false;
    }
    return true;
}

function check_phone() {
    global $phone, $errors;
    if (empty($phone)) {
        return true;
    }
    $regex = "/^[\d]{8,50}$/";
    if (preg_match($regex, $phone) === 0) {
        $errors["firstname"] = "Phone is not valid";
        return false;
    }
    return true;
}


if (check_username() && check_password() && check_firstname() && check_lastname() && check_birthdate() && check_phone() ) {
    include (dirname(__DIR__) . "../model/User.php");
    $User = new User();
    $User->post($username, $password, $firstname, $lastname, boolval($birthdate)?$birthdate:null, boolval($phone)?$phone:null);
    header("Location: http://localhost/pwa/zapoctova_prace/login.php");
}
?>