<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model yii\data\ActiveDataProvider */

$this->title = 'Мои отпуски';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-index">

    <p style="margin: 20px 0px">
        <?= Html::a('Запланировать отпуск', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'date_start', 'format' => ['date', 'php:d.m.Y'], 'label' => 'Дата начала'],
            ['attribute' => 'date_end', 'format' => ['date', 'php:d.m.Y'], 'label' => 'Дата окончания'],
            'confirmed:boolean:Зафиксировано',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => false,
                    'update' => function($model) { return !$model->confirmed; },
                    'delete' => function($model) { return !$model->confirmed; }
                ],
            ],
        ],
    ]); ?>

</div>
