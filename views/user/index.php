<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p style="margin: 20px 0px">
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="bg-white">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'email:text:Почта',
                'full_name:text:Ф.И.О.',
                'is_admin:boolean:Руководитель',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'visibleButtons' => [
                        'update' => Yii::$app->user->identity->is_admin,
                        'delete' => function($model) { return $model->id !== 1 && Yii::$app->user->identity->is_admin; },
                    ],
                ],
            ],
            'tableOptions' => [
                'class' => 'table table-stripped'
            ],
        ]); ?>
    </div>


</div>
