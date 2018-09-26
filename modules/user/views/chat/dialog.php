<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\assets\ChatAsset;

ChatAsset::register($this);

?>

<div class="input-new-message-form container">
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

<?php \yii\widgets\Pjax::begin() ?>

<div class="container messages-block">
    <?php foreach ($chat->messages as $message): ?>
        <?php if ($message->author_id == $user->id): ?>
            <div class="message user">
                <p>From you:</p>
                <p><?= $message->message ?></p>
                <p><?= $message->created_at ?></p>
            </div>
        <?php else : ?>
            <div class="message companion">
                <p>From <?= $companion->name ?>:</p>
                <p><?= $message->message ?></p>
                <p><?= $message->created_at ?></p>
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



