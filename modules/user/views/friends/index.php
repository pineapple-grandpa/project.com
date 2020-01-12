<?php

use app\assets\ProfileAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

ProfileAsset::register($this);

?>

<div style="display: flex; justify-content: space-between;">
    <div style="border: 1px solid gainsboro; padding: 10px; text-align: center;  width: 600px;">
        <h3>Your friends:</h3>
        <div style="display: flex; justify-content: space-around;">
            <?php foreach ($friends as $friend) : ?>
                <div>
                    <div><a href="/user/profile?id=<?= $friend->id ?>&lim=10">
                            <img style="width: 50px; height: 50px; border-radius: 50%;"
                                 src="/img/avatars/<?= $friend->avatar ?>"></a>
                        <p><?= $friend->name ?></p>
                    </div>
                    <div>
                        <button onclick="delete_friend(<?= $owner->id ?>,<?= $friend->id ?>)" class="btn btn-default">
                            delete from friends
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
    <div style="border: 1px solid gainsboro; padding: 10px;">
        <h3>Sended invites:</h3>
        <div style="display: flex; justify-content: space-around; flex-wrap: wrap;margin: 5px;">
            <?php foreach ($invitesTo as $user) : ?>
                <div style="text-align: center;">
                    <div><a href="/user/profile?id=<?= $user->id ?>&lim=10">
                            <img style="width: 50px; height: 50px; border-radius: 50%;"
                                 src="/img/avatars/<?= $user->avatar ?>"></a>
                        <p><?= $user->name ?></p>
                    </div>
                    <div>
                    <button onclick="delete_invite(<?= $user->id ?>,<?= $owner->id ?>)" class="btn btn-default">Cancel
                    </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div style="border: 1px solid gainsboro; padding: 10px;">
        <h3>invites from:</h3>
        <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
            <?php foreach ($invitesFrom as $user) : ?>
                <div style="margin: 5px;">
                    <div style="text-align: center; ">
                        <a href="/user/profile?id=<?= $user->id ?>&lim=10">
                            <img style="width: 50px; height: 50px; border-radius: 50%;"
                                 src="/img/avatars/<?= $user->avatar ?>"></a>
                        <p><?= $user->name ?></p>
                    </div>
                    <div>

                        <?php $form = ActiveForm::begin([
                            'id' => 'send_invite_form_' . $user->id,
                            'method' => 'post',
                            'action' => '/user/friends/invite'
                        ]) ?>

                        <?= $form->field($inviteModel, 'from_user')->hiddenInput(['value' => $owner->id])->label(false) ?>
                        <?= $form->field($inviteModel, 'to_user')->hiddenInput(['value' => $user->id])->label(false) ?>

                        <div>
                            <?= Html::submitButton('Accept', ['class' => 'btn btn-success', 'onclick' => 'send_invite(' . $user->id . ')']) ?>
                        </div>

                        <?php ActiveForm::end() ?>
                    </div>
                </div>


            <?php endforeach; ?>
        </div>
    </div>

</div>

