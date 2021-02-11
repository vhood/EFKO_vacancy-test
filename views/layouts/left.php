<aside class="main-sidebar">

    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => [
                ['label' => Yii::$app->user->identity->email, 'options' => ['class' => 'header']],
                ['label' => 'Профиль', 'icon' => 'user', 'url' => ['user/view', 'id' => Yii::$app->user->identity->id]],
                ['label' => 'Мои отпуски', 'icon' => 'plane', 'url' => ['vacation/user-index']],

                ['label' => 'Компания', 'options' => ['class' => 'header']],
                ['label' => 'Список сотрудников', 'icon' => 'users', 'url' => ['user/index']],
                ['label' => 'Отпуски сотрудников', 'icon' => 'map', 'url' => ['vacation/index']],

                ['label' => 'development mode', 'options' => ['class' => 'header'], 'visible' => YII_DEBUG && Yii::$app->user->identity->is_admin],
                [
                    'label' => 'Инструменты',
                    'icon' => 'share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                        ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    ],
                    'visible' => YII_DEBUG && Yii::$app->user->identity->is_admin
                ]
            ],
        ]) ?>
    </section>

</aside>
