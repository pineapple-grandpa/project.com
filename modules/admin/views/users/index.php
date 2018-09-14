<?php

use yii\grid\GridView;

?>


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
        //'birth_date',
        [
            'attribute' => 'birth_date',
            'format' => ['date', 'dd.MM.yyyy']
        ],
        [
            'attribute' => 'gender',
            'value' => function ($model, $key, $index, $column) {
                return $model->{$column->attribute} === 1 ? 'male' : 'female';
            },
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ]
]); ?>