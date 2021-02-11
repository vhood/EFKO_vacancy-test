<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отпуски';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'userRow:text:Сотрудник',
            ['attribute' => 'date_start', 'format' => ['date', 'php:d.m.Y'], 'label' => 'Дата начала'],
            ['attribute' => 'date_end', 'format' => ['date', 'php:d.m.Y'], 'label' => 'Дата окончания'],
            'confirmed:boolean:Зафиксировано',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm}',
                'buttons' => [
                    'confirm' => function ($url, $model, $key) {
                        $options = [
                            'title' => 'Зафиксировать',
                            'aria-label' => 'Зафиксировать',
                            'data-pjax' => '0',
                            'id' => 'info-'.$key,
                            'data-method' => 'post',
                        ];

                        $url = Url::toRoute(['vacation/confirm', 'id' => $key]);
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-ok"]);

                        return Html::a($icon, $url, $options);
                    },
                ],
                'visibleButtons' => [
                    'confirm' => function($model) {
                        return !$model->confirmed && Yii::$app->user->identity->is_admin;
                    }
                ]
            ],
        ],
    ]); ?>


</div>
