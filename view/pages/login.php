<?php 
include(dirname(__DIR__) . "../../authentication/login.php");
include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=ROOT_PATH?>/public/css/login.css">
    <link rel="stylesheet" href="<?=ROOT_PATH?>/public/css/main.css">
    <link rel="shortcut icon" href="<?=ROOT_PATH?>/public/favicon/favicon-16x16.png" type="image/png" size="16x16">
    <link rel="shortcut icon" href="<?=ROOT_PATH?>/public/favicon/favicon-32x32.png" type="image/png" size="32x32">
</head>
<body>
    <div class="login-page page">
        <div class="login-index">
            <div class="login-htm">
                <form action="./login.php" method="post">
                    <div class="login-fail-message">
                        <?= !isset($login)? "" : ($login ? "Login success" : "Login fail<br>") ?>
                        <?= $error_username ?>
                        <?= $error_password ?>
                    </div>
                    <label for="username">
                        Username
                        <input type="text" name="username" id="username" required><br>
                    </label>
                    <label for="password">
                        Password
                        <input type="password" name="password" id="password" required>
                    </label>
                    <button type="submit">Sign in</button>
                    <a href="<?=ROOT_PATH?>/register.php">Sign up</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

