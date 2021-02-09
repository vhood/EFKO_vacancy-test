<?php
$menu = [
    ['label' => 'Мои отпуски', 'icon' => 'dashboard', 'url' => '#'],
    ['label' => 'Отпуски сотрудников', 'icon' => 'file-code-o', 'url' => '#'],
];
if (YII_DEBUG) $menu[] = [
    'label' => 'Разработка',
    'icon' => 'share',
    'url' => '#',
    'items' => [
        ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
        ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
    ],
];
?>

<aside class="main-sidebar">

    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => $menu,
        ]) ?>
    </section>

</aside>
