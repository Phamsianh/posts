<div class="posts">
    <div class="new-post">
        <a href="<?= ROOT_PATH ?>/posts.php?op=create">Create new post</a>
    </div>
    <?php foreach ($posts as $post) { ?>
    <div class="post" id="post<?= $post['id'] ?>">
        <h3 class="title"><?= $post['title'] ?></h3>
        <p class="created_at">
            <?php $post_author = UserController->get_from_id($post['author_id']); ?>
            <a class="post-author" href="<?= ROOT_PATH . '/users.php/' . $post_author['id']?>">
                <?= $post_author['firstname'] . ' ' . $post_author['lastname']?>
            </a> - <?= $post['created_at'] ?>
        </p>
        <p class="post-content"><?= $post['content'] ?></p>
        <details>
            <summary>Description</summary>
            <p class="description"><?= $post['description'] ?></p>
        </details>
        <div class="manipulate-options">
            <button class="option-button">
                <span class="material-symbols-outlined">more_vert</span>
            </button>
            <div class="options">
                <?php if(empty($_GET['id']) || $_GET['id'] != $post['id']){
                    echo "<a href='" . ROOT_PATH . '/posts.php?id=' . $post['id'] . "'>View post</a>";
                }
                if($post['author_id'] == current_user['id']){
                    echo "<a href='" . ROOT_PATH . '/posts.php?id=' . $post['id'] . "&op=update'>Update post</a>";
                    if(!empty($_GET["filter"]) && $_GET["filter"] == "my_posts"){
                        echo "<a href='" . ROOT_PATH . '/posts.php?id=' . $post['id'] . "&op=delete&filter=my_posts'>Delete post</a>";
                    }
                    else{
                        echo "<a href='" . ROOT_PATH . '/posts.php?id=' . $post['id'] . "&op=delete'>Delete post</a>";
                    }
                }
                ?>
            </div>
        </div>
        
        <hr class="post-comment-separator">
        
        <div class="comments">
        Comments
        <?php $comments = UserController->get_comments($post['id']);
        foreach ($comments as $comment) { 
            $comment_author = UserController->get_from_id($comment['author_id']);
        ?>
            <div class="comment" id="comment<?= $comment['id'] ?>">
                <a class="comment-author" href="<?= ROOT_PATH . '/users.php/' . $comment_author['id']?>">
                    <?= $comment_author['firstname'] . ' ' . $comment_author['lastname']?>
                </a> - <?= $comment['created_at'] ?>
                <p class="comment-content">
                    <?= $comment['content'] ?>
                </p>
                <div class="manipulate-options">
                    <button class="option-button">
                        <span class="material-symbols-outlined">more_vert</span>
                    </button>
                    <div class="options">
                        <a href="<?= ROOT_PATH . '/comments.php?id=' . $comment['id'] . '&op=read'?>">View comment</a>
                        <?php 
                        if($comment['author_id'] == current_user['id']){
                            echo 
                            "<a href='" . ROOT_PATH . '/comments.php?id=' . $comment['id'] . "&op=update#update-comment'>Update comment</a>\n" .
                            "<a href='" . ROOT_PATH . '/comments.php?id=' . $comment['id'] . "&op=delete'>Delete comment</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
        <div>
            <form class="new-comment" method="POST" action="./comments.php?op=create">
                <input type="hidden" name="post_id" value="<?= $post['id']?>">
                <input type="text" name="content" class='comment-content' required>
                <button type="submit">Comment</button>
            </form>
        </div>
    </div>
    <?php } ?>
</div>