<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;


$this->title = 'Settings';
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]) ?>

    <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $form->field($model, 'name')->textInput(['value' => $user->name]) ?>
        <?= $form->field($model, 'email')->textInput(['value' => $user->email]) ?>
        <?php $items = ['male' => 'male', 'female' => 'female'];
        echo $form->field($model, 'gender')->dropDownList($items, ['value' => $user->gender]) ?>
        <?= $form->field($model, 'birth_date')->widget(
            DatePicker::className(), [
            'name' => 'check_issue_date',
            'value' => date('Y-m-d'),
            'options' => ['placeholder' => 'Select your birth date', 'value' => date($user->birth_date)],
            'pluginOptions' => [
                'format' => 'yyyy-m-d',
                'todayHighlight' => true
            ]
        ]); ?>

        <h3>Options</h3>

        <?php $list = ['0' => 'disabled', '1' => 'enabled'];
        $option = $user->getOption('access_to_guests_to_write_on_wall');
        echo $form->field($model, 'option_value')->dropDownList($list, ['value' => $option->value])->label('Access to wall ') ?>

        <?= $form->field($model, 'option_id')->hiddenInput(['value' => $option->id])->label(false) ?>


        <div class="col-lg-offset-1 col-lg-11">
            <a class="btn btn-success" href="/user/profile?id=<?= Yii::$app->user->getId() ?>">Back</a>
            <?= Html::submitButton('Save changes', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>