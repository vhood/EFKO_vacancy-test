<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller as YiiController;

class Controller extends YiiController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
	{
		return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
        ];
	}
}
