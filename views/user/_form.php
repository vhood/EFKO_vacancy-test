<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <div style="margin-top: 20px">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form
            ->field($model, 'email')
            ->textInput(['maxlength' => true])
            ->label('Почта') ?>

        <?= $form
            ->field($model, 'password')
            ->passwordInput(['value' => ''])
            ->label('Пароль') ?>

        <?= $form
            ->field($model, 'full_name')
            ->textInput(['maxlength' => true])
            ->label('Ф.И.О.') ?>

        <?php if (Yii::$app->user->identity->is_admin) :?>
            <?= $form
                ->field($model, 'is_admin')
                ->checkbox([
                    'label' => 'Является руководителем',
                    'style' => 'vertical-align: top; margin-right:4px'
                ])->label('') ?>
        <?php endif; ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
