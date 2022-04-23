<?php 
include_once dirname(__FILE__) . '/../../config.php';
include_once DIR_ROOT . "authentication/check_session.php";

?>
<nav>
    <div class="left">
        <a href="<?=ROOT_PATH?>/posts.php?filter=my_posts">My Posts</a>
        <a href="<?=ROOT_PATH?>/posts.php?limit=20&offset=0">Posts</a>
    </div>
    <div class="right">
        <div class="manipulate-option">
            <button class="option-button">Users</button>
            <div class="options">
                <a href="<?=ROOT_PATH?>/users.php">Profile</a>
                <a href="<?=ROOT_PATH?>/users.php?op=update">Update Profile</a>
                <a href="<?=ROOT_PATH?>/users.php?op=change_password">Change password</a>
                <a href="<?=ROOT_PATH?>/login.php">Sign out</a>
                <a href="<?=ROOT_PATH?>/register.php">Add new account</a>
            </div>
        </div>
    </div>
</nav>