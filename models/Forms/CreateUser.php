<?php

namespace app\models\Forms;

use yii\base\Model;
use app\models\ActiveRecord\User;

/**
 * CreateUser is the model behind the user creation form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class CreateUser extends Model
{
    public $email;
    public $password;
    public $full_name;
    public $is_admin;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['is_admin', 'boolean', 'message' => 'Неверное значение чекбокса'],
            ['password', 'string', 'min' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'e-mail',
            'password' => 'Пароль',
            'full_name' => 'Ф.И.О.',
        ];
    }
}
