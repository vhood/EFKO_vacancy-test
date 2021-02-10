<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\User */

$this->title = 'Редактирование пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
