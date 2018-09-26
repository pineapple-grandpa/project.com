<?php

use app\models\User;

?>
<h1>Chats</h1>
<div style="display: flex; justify-content: space-around;">
    <?php foreach ($chats as $chat) : ?>
        <?php if ($chat->first_user_id == $user->id) {
            $second_user_id = $chat->second_user_id;
        } else {
            $second_user_id = $chat->first_user_id;
        } ?>
        <?php $second_user = User::findIdentity($second_user_id); ?>
    <div style="border: 1px solid gainsboro; text-align: center">
        <p><?= $second_user->name; ?></p>
        <img style="width: 100px; height: 100px; border-radius: 50%" src="/img/avatars/<?= $second_user->avatar?>">
    </div>
<?php endforeach; ?>
</div>