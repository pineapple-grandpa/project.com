<?php

use app\models\User;
use app\assets\ChatAsset;

ChatAsset::register($this);
?>

<h1>Chats</h1>
<div class="chats">

    <?php foreach ($chats as $chat) : ?>
        <?php if ($chat->first_user_id == $user->id) {
            $second_user_id = $chat->second_user_id;
        } else {
            $second_user_id = $chat->first_user_id;
        } ?>
        <?php $second_user = User::findIdentity($second_user_id); ?>

   <a href="/user/chat/dialog?id=<?= $chat->id?>"> <div>
        <p><?= $second_user->name; ?></p>
        <img src="/img/avatars/<?= $second_user->avatar?>">
    </div></a>

<?php endforeach; ?>
</div>