<?php
include_once DIR_ROOT . 'model/Posts.php';
$Post = new Post();
$new_post = $Post->delete(
    $Post->check_input($post['id']),
);
if (!empty($_GET["filter"]) && $_GET['filter'] == 'my_posts'){
    header('Location: ' . SERVER_DOMAIN . ROOT_PATH . '/posts.php?filter=my_posts');
    return;
}
header('Location: ' . SERVER_DOMAIN . ROOT_PATH . '/posts.php');
?>