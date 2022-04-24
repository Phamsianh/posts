<div class="posts">
    <div class="post">
        <form action="./posts.php?op=update" method="POST">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <label>
                Title
                <input type="text" name="title" id="title" value="<?= $post['title'] ?>">
            </label>
            <label>
                Description
                <input type="text" name="description" id="description" value="<?= $post['description'] ?>">
            </label>
            <label>
                Content
                <textarea name="content" id="content" cols="30" rows="10" ><?= $post['content'] ?></textarea>
            </label>
            <button type="submit">Post</button>
        </form>
    </div>
</div>