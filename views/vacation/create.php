<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\Vacation */

$this->title = 'Запланировать отпуск';
$this->params['breadcrumbs'][] = ['label' => 'Мои отпуски', 'url' => ['user-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
