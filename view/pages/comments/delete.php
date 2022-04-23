<?php
if (!$comment["author_id"] == current_user["id"]){
    echo "You are not author of this comment";
    return;
}
include_once DIR_ROOT . 'model/Comments.php';
$Comment->delete($comment['id']);
header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/posts.php?id=' . $comment['post_id']);
?>