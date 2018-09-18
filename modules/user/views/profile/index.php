<div class="container">
<div style="text-align: center; width: 300px;">
    <text><b><?= $user->role; ?></b></text><br>

<img style="height: 200px; width: 200px; border-radius: 50%" src="/img/avatars/<?= $user->avatar?>"><br><br>

<label for="name">Name:</label>
<text id="name"><?= $user->name; ?></text><br>
<label for="email">E-mail:</label>
<text id="email"><?= $user->email;?></text><br>
<label for="gender">Gender:</label>
<text id="gender"><?= $user->gender; ?></text><br>
<label for="birth_date">Birth date:</label>
<text id="birth_date"><?= $user->birth_date; ?></text><br>
    <div>
        <a href="" class="btn btn-success">Send message</a><br>
        <a href="" class="btn btn-success">Send invite</a><br>
    </div>

</div> <br>

<div>
    <a href="/user/default/all" class="btn btn-danger">back</a><br>
</div>

</div>