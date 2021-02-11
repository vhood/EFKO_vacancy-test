<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\Vacation */

$this->title = 'Редактировать отпуск';
$this->params['breadcrumbs'][] = ['label' => 'Мои отпуски', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="vacation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
