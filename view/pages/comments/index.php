<?php
include_once dirname(__FILE__) . '/../../../config.php';
include_once DIR_ROOT . 'view/layout/head.php';

include_once DIR_ROOT . 'view/layout/header.php';
include_once DIR_ROOT . 'view/layout/navbar.php';
include_once DIR_ROOT . 'model/Comments.php';
include_once DIR_ROOT . 'model/Posts.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_GET['op']) || $_GET['op'] == 'create') {
        include_once DIR_ROOT . 'model/Comments.php';
        $Comment = new Comment();
        $new_comment = $Comment->post(
            current_user['id'],
            $Comment->check_input($_POST['post_id']),
            $Comment->check_input($_POST['content'])
        );
        header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/posts.php#comment' . $new_comment['id']);
    }
    else if ($_GET['op'] == 'update'){
        $Comment = new Comment();
        $old_comment = $Comment->get_from_id($Comment->check_input($_POST['id']));
        if ($old_comment['author_id'] != current_user['id']){
            header('Location: ' . SERVER_DOMAIN . ROOT_PATH . '/forbidden.php');
        }
        $updated_comment = $Comment->update(
            $Comment->check_input($_POST['id']),
            $Comment->check_input($_POST['content'])
        );
        header("Location: " . SERVER_DOMAIN . ROOT_PATH . '/posts.php?id=' . $updated_comment['post_id'] . '#comment' . $updated_comment['id']);
    }
}
else {
    // if the query param 'id' is not set, redirect to /posts.php
    if(empty($_GET['id']) || !is_numeric($_GET['id'])){
        header('Location: ' . ROOT_PATH . '/posts.php');
    }

    $Comment = new Comment();
    $comment = $Comment->get_from_id($_GET['id']);
    if (empty($comment)){
        echo "Comment not found";
        return;
    }
    if (empty($_GET['op']) || $_GET['op'] == 'read') {
        header('Location: ' . ROOT_PATH . '/posts.php?id=' . $comment['post_id'] . '#comment' . $comment['id']);
    }
    if ($_GET['op'] == 'update'){
        if ($comment["author_id"] != current_user['id']){
            header('Location: ' . ROOT_PATH . '/forbidden.php');
        }
        include_once DIR_ROOT . 'view/pages/comments/update.php';
    }
    else if ($_GET['op'] == 'delete'){
        if ($comment["author_id"] != current_user['id']){
            header('Location: ' . ROOT_PATH . '/forbidden.php');
        }
        include_once DIR_ROOT . 'view/pages/comments/delete.php';
    }
}
?>

<?php include_once DIR_ROOT . 'view/layout/footer.php';?>
