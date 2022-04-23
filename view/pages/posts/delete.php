<?php
include_once DIR_ROOT . 'model/Posts.php';
$Post = new Post();
$new_post = $Post->delete(
    $Post->check_input($post['id']),
);
header('Location: ' . SERVER_DOMAIN . ROOT_PATH . '/posts.php');
?>