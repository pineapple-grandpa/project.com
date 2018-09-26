<?php

use app\models\User;

?>

<?php if ($chat->first_user_id == $user->id) {
    $second_user_id = $chat->second_user_id;
} else {
    $second_user_id = $chat->first_user_id;
} ?>

<?php $second_user = User::findIdentity($second_user_id); ?>



<div class="container" style="width: 800px">
    <?php foreach ($chat->messages as $message): ?>
        <?php if ($message->author_id == $user->id): ?>
            <div style="background-color: #5bc0de; padding: 10px; margin-bottom: 10px;">
                <p>From you:</p>
                <p><?= $message->message ?></p>
                <p><?= $message->created_at ?></p>
            </div>
        <?php else : ?>
            <div style="padding: 10px; margin-bottom: 10px;">
                <p>From <?= $second_user->name ?>:</p>
                <p><?= $message->message ?></p>
                <p><?= $message->created_at ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>