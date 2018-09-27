<div>
<?php foreach ($friends as $friend) :?>
<div>
    <img style="width: 50px; height: 50px; border-radius: 50%;" src="/img/avatars/<?= $friend->avatar ?>">
    <p><?= $friend->name ?></p>
</div>

<?php endforeach; ?>
</div>