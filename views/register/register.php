<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;


$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
    'method' => 'post',
    'action' => Url::to(['/register/register'])
]) ?>


<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model,'password')->passwordInput() ?>
    <?= $form->field($model,'confirm_password')->passwordInput() ?>
    <?php $items = ['male'=>'male','female'=>'female'];
    echo $form->field($model,'gender')->dropDownList($items) ?>
    <?= $form->field($model, 'birth_date')->widget(
        DatePicker::className(),[
        'name' => 'check_issue_date',
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Select your birth date'],
        'pluginOptions' => [
            'format' => 'yyyy-m-d',
            'todayHighlight' => true
        ]
    ]); ?>

    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Register', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>
