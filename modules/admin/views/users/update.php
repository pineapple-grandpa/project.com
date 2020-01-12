<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;


$this->title = 'Update user: ' . $user->name;

?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]) ?>


    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $form->field($model, 'name')->textInput(['value'=>$user->name]) ?>
        <?= $form->field($model, 'email')->textInput(['value'=>$user->email]) ?>
        <?php $roleItems = ['user'=>'user','moder'=>'moder'];
        echo $form->field($model, 'role')->dropDownList($roleItems,['value'=>$user->role]) ?>
        <?php $genderItems = ['male'=>'male','female'=>'female'];
        echo $form->field($model,'gender')->dropDownList($genderItems,['value'=>$user->gender]) ?>
        <?= $form->field($model, 'birth_date')->textInput(['value' => $user->birth_date]) ?>

        <h3>Options</h3>

        <?php $list = ['0' => 'disabled', '1' => 'enabled'];
        $option = $user->getOption('access_to_guests_to_write_on_wall');
        echo $form->field($model, 'option_value')->dropDownList($list, ['value' => $option->value])->label('Access to wall ') ?>

        <?= $form->field($model, 'option_id')->hiddenInput(['value' => $option->id])->label(false) ?>

        <div class="col-lg-offset-1 col-lg-11">
            <a class="btn btn-success" href="/admin/users">Back</a>
            <?= Html::submitButton('Update', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>