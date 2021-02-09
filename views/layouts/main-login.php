<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use dmstr\web\AdminLteAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminLteAsset::register($this);
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page bg-black-gradient">
    <?php
        $this->beginBody();
        echo $content;
        $this->endBody();
    ?>
</body>
</html>
<?php $this->endPage() ?>
