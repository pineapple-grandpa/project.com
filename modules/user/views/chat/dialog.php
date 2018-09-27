<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\assets\ChatAsset;

ChatAsset::register($this);

$messageArray = [];
?>

<h3 class="container chat-name" style="">Chat with <?= $companion->name ?>
    <img src="/img/avatars/<?= $companion->avatar ?>">
</h3>

<div id="inputMessageForm" class="input-new-message-form message-form container">
    <?php $form = ActiveForm::begin([
    ]) ?>

    <div>
        <?= $form->field($model, 'message')->textInput()->label(false); ?>
        <?= $form->field($model, 'chat_id')->hiddenInput(['value' => $chat->id])->label(false) ?>
        <?= $form->field($model, 'author_id')->hiddenInput(['value' => $user->id])->label(false) ?>

        <div class="text-right">
            <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end() ?>
</div>

<div  id="editMessageForm" class="edit-message-form  message-form container">
    <?php $form = ActiveForm::begin([
        'id' => 'edit_message_form',
        'method' => 'POST',
        'action' => '/user/chat/edit',
    ]) ?>

    <div>
        <?= $form->field($editMessageModel, 'message')->textInput(['id' => 'editMessageInput'])->label(false); ?>
        <?= $form->field($editMessageModel, 'message_id')->hiddenInput(['id' => 'editMessageIdInput'])->label(false) ?>

        <div class="text-right">
            <a onclick="cancel_edit()" class="btn btn-default">Cancel</a>
        </div>
        <div class="text-right">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'onclick' => 'save_changes()']) ?>
        </div>

    </div>

    <?php ActiveForm::end() ?>
</div>

<?php \yii\widgets\Pjax::begin() ?>

<div class="container messages-block">
    <?php $messageCount = 0; ?>
    <?php foreach ($chat->messages as $message): ?>
        <?php if ($message->author_id == $user->id): ?>
            <?php $messageCount++;
            $messageArray[$messageCount] = $message;
            ?>
            <div class="message user">
                <div class="content">
                    <p>From <img src="/img/avatars/<?= $user->avatar ?>"> you:</p>
                    <p><?= $message->message ?> </p>
                    <p><?= $message->created_at ?></p>
                </div>
                <div class="buttons">
                    <div>
                        <a class="btn btn-default"
                           onclick="show_edit_message_form(<?= $messageArray[$messageCount]->id ?>,'<?= $messageArray[$messageCount]->message ?>')">edit</a>
                    </div>
                </div>

            </div>
        <?php else : ?>
            <div class="message companion">
                <div class="content">
                    <p>From <img src="/img/avatars/<?= $companion->avatar ?>"> <?= $companion->name ?> :</p>
                    <p><?= $message->message ?></p>
                    <p><?= $message->created_at ?></p>
                </div>
                <div class="buttons">
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?= Html::a(
    'Обновить',
    ['/user/chat/dialog?id=' . $chat->id],
    ['class' => 'btn btn-lg btn-primary', 'id' => 'refresh', 'style' => 'display:none;']
) ?>
<?php \yii\widgets\Pjax::end() ?>


