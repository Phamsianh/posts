<div class="page">
    <div class="profile">
        <div class="row">
            <p class="name">Name:</p>
            <p class="value"><?= current_user['firstname'] . ' ' . current_user['lastname'] ?></p>
        </div>
        <div class="row">
            <p class="name">User name:</p>
            <p class="value"><?= current_user['username'] ?></p>
        </div>
        <div class="row">
            <p class="name">Birthday:</p>
            <p class="value"><?= current_user['birthdate'] ?></p>
        </div>
        <div class="row">
            <p class="name">Phone:</p>
            <p class="value"><?= current_user['phone'] ?></p>
        </div>
    </div>
</div>