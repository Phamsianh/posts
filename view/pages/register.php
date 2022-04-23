<?php 
include(dirname(__DIR__) . "../../authentication/register.php");
include_once 'config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?=ROOT_PATH?>/public/css/login.css">
    <link rel="stylesheet" href="<?=ROOT_PATH?>/public/css/main.css">
    <link rel="shortcut icon" href="<?=ROOT_PATH?>/public/favicon/favicon-16x16.png" type="image/png" size="16x16">
    <link rel="shortcut icon" href="<?=ROOT_PATH?>/public/favicon/favicon-32x32.png" type="image/png" size="32x32">
</head>
<body>
    <div class="login-page page">
        <div class="signup">
            <div class="signup-htm">              
                <form action="./register.php" method="post">
                    <div class="login-fail-message">
                        <div class="error"><?= $errors["username"]?></div>
                        <div class="error"><?= $errors["password"]?></div>
                        <div class="error"><?= $errors["firstname"]?></div>
                        <div class="error"><?= $errors["lastname"]?></div>
                        <div class="error"><?= $errors["birthdate"]?></div>
                        <div class="error"><?= $errors["phone"]?></div>
                    </div>
                    <label for="username">
                        User name
                        <input type="text" name="username" id="username" maxlength="50" required><br>
                    </label>
            
                    <label for="password">
                        Password
                        <input type="password" name="password" id="password" maxlength="50" required><br>
                    </label>
            
                    <label for="firstname">
                        First name
                        <input type="text" name="firstname" id="firstname" maxlength="50" required><br>
                    </label>
            
                    <label for="lastname">
                        Last name
                        <input type="text" name="lastname" id="lastname" maxlength="50" required><br>
                    </label>
            
                    <label for="birthdate">
                        Birtdate
                        <input type="date" name="birthdate" id="birthdate"><br>
                    </label>
            
                    <label for="phone">
                        Phone
                        <input type="number" name="phone" id="phone" maxlength="20">
                    </label>
                    
                    <button type="submit">Sign up</button>
                    <a href="<?=ROOT_PATH?>/login.php">Sign in</a>
            </div>
        </div>
    </div>
    </form>
</body>
</html>