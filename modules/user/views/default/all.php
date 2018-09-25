
<div class="container" style="display: flex; justify-content: space-around">

<?php foreach ($users as $user) : ?>
    <div style="margin-bottom: 20px; border: 1px solid gainsboro; text-align: center; border-radius: 3%; padding: 10px;" class="user">
        <text><b><?= $user->role ?></b></text><br>
        <img style="width: 100px; height: 100px; border-radius: 50%;" src="/img/avatars/<?= $user->avatar ?>"> <br>

        <label for="name">Name:</label>
        <text id="name"><?= $user->name ?></text><br>

        <label for="email">Email:</label>
        <text id="email"><?= $user->email ?></text><br>

        <label for="gender">Gender:</label>
        <text id="gender"><?= $user->gender ?></text><br>

        <label for="birth_date">Birth date:</label>
        <text id="birth_date"><?= $user->birth_date ?></text><br>

        <a href="/user/profile?id=<?= $user->id ?>&lim=10" class="btn btn-success">Go to profile</a><br>
        <a href="" class="btn btn-success">Send message</a><br>
        <a href="" class="btn btn-success">Send invite</a><br>

    </div>
<?php endforeach; ?>


</div>
