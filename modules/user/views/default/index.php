<div class="container" >
    <div style="width: 300px; text-align: center;">
        <div>
            <text><b><?= $user->role; ?></b></text>
        </div><br>

        <img style="height: 200px; width: 200px; border-radius: 50%" src="/img/avatars/<?= $user->avatar?>"><br><br>

        <div>
            <a class="btn btn-default" href="/user/settings/avatar">Change avatar</a>
        </div><br>

        <label for="name">Name:</label>
        <text id="name"><?= $user->name; ?></text><br>
        <label for="email">E-mail:</label>
        <text id="email"><?= $user->email;?></text><br>
        <label for="gender">Gender:</label>
        <text id="gender"><?= $user->gender; ?></text><br>
        <label for="birth_date">Birth date:</label>
        <text id="birth_date"><?= $user->birth_date; ?></text>

        <div>
            <a class="btn btn-success" href="/user/settings">Settings</a>
        </div>
    </div>

</div>


