<?php

use app\assets\ProfileAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

ProfileAsset::register($this);
$guest = Yii::$app->user->identity;
$isOwner = ($user->getId() === $guest->getId());
?>


<body>
<div class="container main-content">
    <div class="user-description">

        <p><?= $user->role; ?></p>

        <div class="user-avatar">
            <img src="/img/avatars/<?= $user->avatar ?>"><br>
            <?php if ($isOwner) : ?>
                <div class="user-avatar-settings">
                    <a class="btn btn-default" href="/user/settings/avatar">Change avatar</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="user-data">
            <table>
                <tr>
                    <td><b>Name:</b></td>
                    <td><?= $user->name; ?></td>
                </tr>
                <tr>
                    <td><b>E-mail:</b></td>
                    <td><?= $user->email; ?></td>
                </tr>
                <tr>
                    <td><b>Gender:</b></td>
                    <td><?= $user->gender; ?></td>
                </tr>
                <tr>
                    <td><b>Birth date:</b></td>
                    <td><?= $user->birth_date; ?></td>
                </tr>
            </table>
        </div>

        <?php if ($isOwner): ?>
            <div>
                <a class="btn btn-success" href="/user/settings">Settings</a>
            </div>
        <?php else : ?>
            <div>
                <a href="" class="btn btn-success">Send message</a><br>
                <a href="" class="btn btn-success">Send invite</a><br>
            </div>
        <?php endif; ?>
    </div>


    <div class="user-wall">
        <?php if ($user->isOption('access_to_guests_to_write_on_wall') || (!$user->isOption('access_to_guests_to_write_on_wall') && $isOwner)) : ?>

            <div class="input-new-article-form">
                <?php $form = ActiveForm::begin() ?>

                <div>
                    <?= $form->field($model, 'message')->textInput()->label(false); ?>
                    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user->id])->label(false) ?>
                    <?= $form->field($model, 'author_id')->hiddenInput(['value' => $guest->getId()])->label(false) ?>
                    <?= $form->field($model, 'author_name')->hiddenInput(['value' => $guest->name])->label(false) ?>
                    <?= $form->field($model, 'author_avatar')->hiddenInput(['value' => $guest->avatar])->label(false) ?>

                    <div class="text-right">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
                    </div>

                </div>

                <?php ActiveForm::end() ?>
            </div>

        <?php endif; ?>

        <?php \yii\widgets\Pjax::begin() ?>

        <div class="wall-article-block">
            <?php $count = 0; ?>
            <?php foreach ($articles as $article) : ?>
                <?php $count++; ?>

                <div class="wall-article-description">

                    <div class="wall-article-author">
                        <a href="/user/profile?id=<?= $article->author_id ?>&lim=10"> <img
                                    style="width: 50px; height: 50px; border-radius: 50%;"
                                    src="/img/avatars/<?= $article->author_avatar ?>"></a>
                        <p><?= $article->author_name ?></p>
                        <p><?= $article->created_at ?></p>
                    </div>

                    <div class="wall-article-content">

                        <div class="wall-article-content-message">
                            <p><?= $article->message ?></p>
                        </div>

                        <div class="wall-article-content-buttons" style="">
                            <?php if ($isOwner || $article->author_id == $guest->id || $guest->isAdmin()) : ?>
                                <div>
                                    <button onclick="remove_articles_comments(<?= $article->id ?>,'article')"
                                            class="btn btn-default">delete
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if ($user->isOption('access_to_guests_to_write_on_wall') || (!$user->isOption('access_to_guests_to_write_on_wall') && $isOwner)) : ?>
                                <div>
                                    <button onclick="input_text_visibility(<?= $article->id ?>);"
                                            class="btn btn-default">
                                        reply
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if ($article->author_id == $guest->id || $guest->isAdmin()) : ?>
                                <div>
                                    <button onclick="edit_text_visibility(<?= $article->id ?>)"
                                            class="btn btn-default">
                                        edit
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>

                <div class="input-comment-form" data-name="input_comment_form" id="<?= $article->id ?>">
                    <?php $form = ActiveForm::begin() ?>

                    <div>
                        <?= $form->field($model2, 'message')->textInput()->label(false); ?>
                        <?= $form->field($model2, 'author_id')->hiddenInput(['value' => $guest->getId()])->label(false) ?>
                        <?= $form->field($model2, 'author_name')->hiddenInput(['value' => $guest->name])->label(false) ?>
                        <?= $form->field($model2, 'author_avatar')->hiddenInput(['value' => $guest->avatar])->label(false) ?>
                        <?= $form->field($model2, 'parent_id')->hiddenInput(['value' => $article->id])->label(false) ?>

                        <div class="text-right">
                            <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end() ?>
                </div>

                <div class="edit-article-form" id="edit_article_id_<?= $article->id ?>">
                    <?php $form = ActiveForm::begin([
                        'id' => 'edit_article_form_' . $article->id,
                        'method' => 'POST',
                        'action' => '/user/article/save',
                        'enableAjaxValidation' => false,
                    ]) ?>

                    <div>
                        <?= $form->field($model, 'message')->textInput(['value' => $article->message])->label(false); ?>
                        <?= $form->field($model, 'article_id')->hiddenInput(['value' => $article->id])->label(false) ?>

                        <div id="edit_article_save" class="text-right">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'onclick' => 'on_click_save_button_edit_form(' . $article->id . ')',]) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end() ?>
                </div>

                <?php foreach ($article->comments as $comment) : ?>
                    <div class="wall-article-comment">

                        <div class="wall-article-comment-author">
                            <a href="/user/profile?id=<?= $comment->author_id ?>">
                                <img src="/img/avatars/<?= $comment->author_avatar ?>"></a> <br>
                            <p><?= $comment->author_name ?></p>
                            <p><?= $comment->created_at ?></p>
                        </div>

                        <div class="wall-article-comment-content">

                            <div class="wall-article-comment-content-message">
                                <p><?= $comment->message ?></p>
                            </div>

                            <div class="wall-article-comment-content-buttons">
                                <?php if ($isOwner || $comment->author_id == $guest->id || $guest->isAdmin()) : ?>
                                    <div>
                                        <button onclick="remove_articles_comments(<?= $comment->id ?>,'comment')"
                                                class="btn btn-default">
                                            delete
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php if ($comment->author_id == $guest->id || $guest->isAdmin()) : ?>
                                    <div>
                                        <button onclick="edit_comment_text_visibility(<?= $comment->id ?>)"
                                                class="btn btn-default">
                                            edit
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>

                    </div>

                    <div class="edit-comment-form" id="edit_comment_id_<?= $comment->id ?>">
                        <?php $form = ActiveForm::begin([
                            'id' => 'edit_comment_form_' . $comment->id,
                            'method' => 'POST',
                            'action' => '/user/comment/save',
                            'enableAjaxValidation' => false,
                        ]) ?>

                        <div>
                            <?= $form->field($model2, 'message')->textInput(['value' => $comment->message])->label(false); ?>
                            <?= $form->field($model2, 'comment_id')->hiddenInput(['value' => $comment->id])->label(false) ?>

                            <div id="edit_comment_save" class="text-right">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'onclick' => 'on_click_save_button_edit_comment_form(' . $comment->id . ')']) ?>
                            </div>

                        </div>

                        <?php ActiveForm::end() ?>
                    </div>

                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

        <?php $count += 5; ?>
        <?= Html::a(
            'Обновить',
            ['/user/profile?id=' . $user->id . '&lim=' . $count],
            ['class' => 'btn btn-lg btn-primary', 'id' => 'scroll', 'style' => 'display:none;']
        ) ?>
        <?php \yii\widgets\Pjax::end() ?>

    </div>

</div>

</body>



<script>

</script>


