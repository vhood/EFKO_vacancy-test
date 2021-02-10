<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\User */

$this->title = 'Пользователь '.$model->email;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->email;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <?php if (Yii::$app->user->identity->is_admin || Yii::$app->user->identity->id === $model->id) : ?>
        <p style="margin: 20px 0px">
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            'full_name',
        ],
    ]) ?>

</div>
