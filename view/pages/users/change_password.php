<div class="page change-password-page">
    <div class="change-password">
        <div class="change-password-htm">
            <form action="<?= ROOT_PATH . '/users.php?op=change_password'?>" method="post">
                <div class="error"><?= $error ?></div>
                <label>
                    Old password
                    <input type="password" name="old" id="old" required>
                </label>
                <label>
                    New password
                    <input type="password" name="new" id="new" required>
                </label>
                <label>
                    Retype new password
                    <input type="password" name="new_again" id="new_again" required>
                </label>
                <button type="submit">Change</button>
            </form>
        </div>
    </div>
</div>