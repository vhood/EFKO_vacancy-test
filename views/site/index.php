<?php

/* @var $this yii\web\View */

$this->title = 'Администрирование';

$welcome = 'Добро пожаловать';
if (Yii::$app->user->identity->full_name) $welcome .= ', '.Yii::$app->user->identity->full_name;
$welcome .= '!';

?>
<div class="site-index">
    <?php $this->beginBlock('content-header'); ?>
        <?= $welcome ?>
    <?php $this->endBlock(); ?>

    <p class="blog-header"><strong>Задание выполнил: <a href="https://github.com/vhood/EFKO_vacancy-test">Виктор Храмов</a></strong></p>
</div>
