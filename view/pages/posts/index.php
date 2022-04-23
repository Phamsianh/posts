<?php
include_once dirname(__FILE__) . '/../../../config.php';

include_once DIR_ROOT . 'view/layout/head.php';

include_once DIR_ROOT . 'view/layout/header.php';
include_once DIR_ROOT . 'view/layout/navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(!empty($_GET['id'])){
        $post_id = $_GET['id'];
        if(!is_numeric($_GET['id'])){
            header('Location: ' . ROOT_PATH . '/posts.php');
        }
        include_once DIR_ROOT . 'model/Posts.php';
        $Post = new Post();
        $post = $Post->get_from_id(intval($post_id));
        if (empty($post)){
            echo "Post not found";
            return;
        }
        if (empty($_GET['op']) || $_GET['op'] == 'read') {
            $posts = [$post];
            include_once DIR_ROOT . 'view/pages/posts/read.php';
        }
        else if ($_GET['op'] == 'update'){
            include_once DIR_ROOT . 'view/pages/posts/update.php';
        }
        else if ($_GET['op'] == 'delete'){
            include_once DIR_ROOT . 'view/pages/posts/delete.php';
        }
        else {
            $posts = [$post];
            include_once DIR_ROOT . 'view/pages/posts/read.php';
        }
    }
    else {
        if (!empty($_GET['op']) && $_GET['op'] == 'create') {
            include_once DIR_ROOT . 'view/pages/posts/create.php';
        }
        else if ($_GET['op'] = 'update') {
            if(!empty($_GET["filter"]) && $_GET["filter"] == "my_posts") {
                $posts = UserController->get_posts(current_user['id']);
                include_once DIR_ROOT . 'view/pages/posts/read.php';
            }
            else {
                include_once DIR_ROOT . 'model/Posts.php';
                $Post = new Post();
                $posts = $Post->get_all(
                    empty($_GET["limit"]) || !is_numeric($_GET["limit"]) ? 20 : intval($_GET["limit"]), 
                    $offset = empty($_GET["offset"]) || !is_numeric($_GET["offset"]) ? 0 : intval($_GET["offset"])
                );
                include_once DIR_ROOT . 'view/pages/posts/read.php';
                include_once DIR_ROOT . 'view/pages/posts/pagination.php';
            }
        }
        else {
            header('Location: ' . ROOT_PATH . '/posts.php');
        }
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_GET['op']) || $_GET['op'] == 'create') {
        include_once DIR_ROOT . 'model/Posts.php';
        $Post = new Post();
        $new_post = $Post->post(
            current_user['id'],
            $Post->check_input($_POST['title']),
            $Post->check_input($_POST['content']),
            $Post->check_input($_POST['description'])
        );
        header('Location: ' . SERVER_DOMAIN . ROOT_PATH . '/posts.php#post' . $new_post['id']);
    }
    else if ($_GET['op'] == 'update'){
        include_once DIR_ROOT . 'model/Posts.php';
        $Post = new Post();
        $new_post = $Post->update(
            $Post->check_input($_POST['post_id']),
            $Post->check_input($_POST['title']),
            $Post->check_input($_POST['content']),
            $Post->check_input($_POST['description'])
        );
        header('Location: ' . SERVER_DOMAIN . ROOT_PATH . '/posts.php#post' . $new_post['id']);
    }
    else {
        header('Location: ' . ROOT_PATH . '/posts.php');
    }
}
else {
    header('Location: ' . ROOT_PATH . '/posts.php');
}
?>

<?php include_once DIR_ROOT . 'view/layout/footer.php';?>
