<?php

/* @var $this yii\web\View */

$this->title = 'Socialnetwork';
?>
<div class="site-index">

    <h1>Эй, Привет!</h1>
   <?php if (!Yii::$app->user->isGuest): ?>
    <a href="/user/default/all" class="btn btn-success">All users</a>
   <?php endif; ?>

</div>
