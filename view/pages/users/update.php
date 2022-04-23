<div class="page update-profile-page">
    <div class="update-profile">
        <div class="update-profile-htm">
            <form action="<?= ROOT_PATH ?>/users.php?op=update" method="POST">
                <label>
                    First name
                    <input type="text" name="firstname" id="firstname" value="<?= current_user['firstname'] ?>">
                </label>
                <label>
                    Last name
                    <input type="text" name="lastname" id="lastname" value="<?= current_user['lastname'] ?>">
                </label>
                <label>
                    Birthday
                    <input type="date" name="birthdate" id="birthdate" value="<?= current_user['birthdate'] ?>">
                </label>
                <label>
                    Phone
                    <input type="number" name="phone" id="phone" value="<?= current_user['phone'] ?>">
                </label>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</div>