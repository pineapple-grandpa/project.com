<?php

use yii\grid\GridView;

?>
<div class="col-lg-offset-1 col-lg-11 text-right ">
    <a class="btn btn-success" href="/admin/users/create">Create</a>
</div> <br>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered'
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        'login',
        'email',
        'role',
        [
            'attribute' => 'birth_date',
            'format' => ['date', 'dd.MM.yyyy']
        ],
        'gender',
        ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
    ]
]); ?>

<div class="col-lg-offset-1 col-lg-11 text-left">
    <a class="btn btn-warning" href="/admin">back</a>
</div>

