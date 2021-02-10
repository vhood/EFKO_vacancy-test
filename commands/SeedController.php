<?php

namespace app\commands;

use Yii;
use yii\console\ExitCode;
use yii\console\Controller;
use app\models\ActiveRecord\User;

class SeedController extends Controller
{
    /**
     * Create an admin user
     *
     * @return int Exit code
     */
    public function actionAdmin()
    {
        if (User::findOne(['email' => 'admin@efko.ru'])) {
            echo "Руководитель уже существует\n";

            return ExitCode::USAGE;
        }

        $user = new User();
        $user->email = 'admin@efko.ru';
        $user->full_name = 'Тестовый Руководитель';
        $user->is_admin = 1;
        $user->password = Yii::$app->security->generatePasswordHash('test');
        $user->save();
        echo "Руководитель создан\n";

        return ExitCode::OK;
    }
}
