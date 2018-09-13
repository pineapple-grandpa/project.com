<?php

/* @var $this yii\web\View */

$this->title = 'Socialnetwork';
?>
<div class="site-index">
    
    <h1>Эй, Привет!</h1>
   <?php if (!Yii::$app->user->isGuest): ?>
    <img src="/img/image.jpg">
   <?php endif; ?>

</div>
