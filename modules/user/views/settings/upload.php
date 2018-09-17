<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>


    <img style="height: 200px; width: 200px; border-radius: 50%" src="/img/avatars/<?= $user->avatar ?>"><br><br>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'avatar')->fileInput()->label(false) ?>

<?= Html::submitButton('Save changes', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>