<?php
include_once dirname(__FILE__) . '/../../../config.php';
include_once DIR_ROOT . 'authentication/check_session.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}
include_once DIR_ROOT . 'model/Comments.php';
$Comment = new Comment();
$new_comment = $Comment->post(
    current_user['id'],
    $Comment->check_input($_POST['post_id']),
    $Comment->check_input($_POST['content'])
);
header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/posts.php#comment' . $new_comment['id']);
?>