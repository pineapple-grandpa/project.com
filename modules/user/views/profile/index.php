<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$guest = Yii::$app->user->identity;
$isOwner = ($user->getId() === $guest->getId());
?>

<div class="container" style="display: flex; ">
    <div style="text-align: center; width: 300px;">
        <text><b><?= $user->role; ?></b></text>
        <br>
        <div style="margin-bottom: 15px">
            <img style="height: 200px; width: 200px; border-radius: 50%" src="/img/avatars/<?= $user->avatar ?>"><br>

            <?php if ($isOwner) : ?>
                <div style="margin-bottom: 15px; margin-top: 10px;">
                    <a class="btn btn-default" href="/user/settings/avatar">Change avatar</a>
                </div>
            <?php endif; ?>
        </div>

        <div style=" display: flex; justify-content: center; margin-bottom: 15px">
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
    <br>


    <div id="wall" style="max-width: 700px">
        <?php if ($user->isOption('access_to_guests_to_write_on_wall') || (!$user->isOption('access_to_guests_to_write_on_wall') && $isOwner)) : ?>
            <div style="width: 700px;">
                <?php $form = ActiveForm::begin() ?>

                <div>
                    <?= $form->field($model, 'message')->textInput()->label(false); ?>
                    <?= $form->field($model, 'author_id')->hiddenInput(['value' => $guest->getId()])->label(false) ?>
                    <?= $form->field($model, 'author_name')->hiddenInput(['value' => $guest->name])->label(false) ?>
                    <?= $form->field($model, 'author_avatar')->hiddenInput(['value' => $guest->avatar])->label(false) ?>

                    <div class="text-right">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
                    </div>

                </div>

                <?php ActiveForm::end() ?>
            </div>
            <br>
        <?php endif; ?>

        <?php \yii\widgets\Pjax::begin() ?>

        <div style="display: flex; flex-wrap: wrap; justify-content: flex-end;">
            <?php $count = 0; ?>
            <?php foreach ($articles as $article) : ?>
                <?php $count++; ?>
                <div style="border: 1px solid gainsboro; display: flex; margin-bottom: 5px; margin-top: 20px; padding: 5px; width: 700px;">
                    <div style="text-align: center; border-right: 1px solid gainsboro; padding-right: 5px; ">
                        <a href="/user/profile?id=<?= $article->author_id ?>&lim=10"> <img
                                    style="width: 50px; height: 50px; border-radius: 50%;"
                                    src="/img/avatars/<?= $article->author_avatar ?>"></a> <br>
                        <text><?= $article->author_name ?></text>
                        <br>
                        <text><?= $article->created_at ?></text>
                    </div>
                    <div style="display: flex; width: 600px; justify-content: space-between;">
                        <div style="align-self: center;padding-left: 5px;">
                            <text><?= $article->message ?></text>
                        </div>

                        <div style="align-self: flex-end; justify-content: space-between; display: flex">
                            <?php if ($isOwner || $article->author_id == $guest->id || $guest->isAdmin()) : ?>
                                <div>
                                    <button data-article-id="<?= $article->id ?>" class="delete btn btn-default">delete
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
                                    <button data-id="edit_article_form_<?= $article->id ?>" onclick="edit_text_visibility(<?= $article->id ?>);"
                                            class="btn btn-default show_edit_article">
                                        edit
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>


                    </div>
                </div><br>
                <div data-name="input_comment_form" style="width: 700px; margin-bottom: 10px; display: none;"
                     id="<?= $article->id ?>">
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
                </div><br>
                <div id="edit_article_id_<?= $article->id ?>" style="width: 700px; display: none;">
                    <?php $form = ActiveForm::begin([
                        'id' => 'edit_article_form_' . $article->id,
                        'method' => 'POST',
                        'action' => '/user/article/save',
                        'enableAjaxValidation' => false,
                        'validationUrl' => '/user/article/validate',
                    ]) ?>

                    <div>
                        <?= $form->field($model, 'message')->textInput(['value' => $article->message])->label(false); ?>
                        <?= $form->field($model, 'article_id')->hiddenInput(['value' => $article->id])->label(false) ?>

                        <div id="edit_article_save" class="text-right">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end() ?>
                </div>

                <?php foreach ($article->comments as $comment) : ?>
                    <div style="border: 1px solid gainsboro; display: flex; margin-bottom: 5px; margin-top: 10px; padding: 5px; width: 560px;">
                        <div style="text-align: center; border-right: 1px solid gainsboro; padding-right: 5px">
                            <a href="/user/profile?id=<?= $comment->author_id ?>"> <img
                                        style="width: 50px; height: 50px; border-radius: 50%;"
                                        src="/img/avatars/<?= $comment->author_avatar ?>"></a> <br>
                            <text><?= $comment->author_name ?></text>
                            <br>
                            <text><?= $comment->created_at ?></text>
                        </div>
                        <div style="display: flex;justify-content: space-between; width: 600px;">
                            <div style="align-self: center;padding-left: 5px">
                                <text><?= $comment->message ?></text>
                            </div>
                            <div style="align-self: flex-end;">
                                <?php if ($isOwner || $comment->author_id == $guest->id || $guest->isAdmin()) : ?>
                                    <div>
                                        <button data-comment-id="<?= $comment->id ?>" class="delete btn btn-default">
                                            delete
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>

        <?php $count += 5; ?>
        <?= Html::a(
            'Обновить',
            ['/user/profile?id=' . $user->id . '&lim=' . $count],
            ['class' => 'btn btn-lg btn-primary', 'id' => 'ajax', 'style' => 'display:none;']
        ) ?>
        <?php \yii\widgets\Pjax::end() ?>

    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript">
    function input_text_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }
</script>

<script type="text/javascript">
    function edit_text_visibility(id) {
        var e = document.getElementById('edit_article_id_' + id);
        if (e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }
</script>

<script>
    function update_data() {
        location.reload();
    }
</script>


<script>
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            $('#ajax').trigger('click');
        }
    });
</script>


<script>
    $(function () {
        $('.delete').on('click', function () {
            var id;
            if (id = $(this).attr("data-article-id")) {

                if (confirm('do you really want to remove this article?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/user/article/delete?id=' + id,
                        complete: function () {
                            location.reload();
                        }
                    })
                }

            } else if (id = $(this).attr("data-comment-id")) {

                if (confirm('do you really want to remove this comment?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/user/comment/delete?id=' + id,
                        complete: function () {
                            location.reload();
                        }
                    })
                }
            }
        })
    })
</script>

<script>
    $(function () {
        <?php ?>
        $("#id-aaa").on('beforeSubmit', function () {
            var $yiiform = $(this);
            $.ajax({
                type: $yiiform.attr('method'),
                url: $yiiform.attr('action'),
                data: $yiiform.serializeArray(),
                complete: function () {
                    location.reload();
                }
            });
            return false;
        })
        <?php ?>
    })


    // $(document).on("beforeSubmit", "#edit_form_", function () {
    //     var $yiiform = $(this);
    //     $.ajax({
    //             type: $yiiform.attr('method'),
    //             url: $yiiform.attr('action'),
    //             data: $yiiform.serializeArray()
    //         }
    //     );
    //     return false; // Cancel form submitting.
    // });
</script>


