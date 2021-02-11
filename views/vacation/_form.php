<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\Vacation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacation-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label">Укажите дату начала и окончания</label>';
    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'date_start',
        'attribute2' => 'date_end',
        'options' => [
            'placeholder' => 'Дата начала',
            'autocomplete' => 'off'
        ],
        'options2' => [
            'placeholder' => 'Дата окончания',
            'autocomplete' => 'off',
        ],
        'type' => DatePicker::TYPE_RANGE,
        'form' => $form,
        'separator' => '→',
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
            'todayHighlight' => true,
        ],
    ]) ?>

    <div class="form-group" style="margin-top: 20px">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
