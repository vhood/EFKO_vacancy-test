<?php

namespace app\models\Forms;

use Yii;
use yii\base\Model;
use app\models\ActiveRecord\User;

/**
 * EditUser the model behind the user updating form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class EditUser extends Model
{
    public $email;
    public $password;
    public $full_name;
    public $is_admin;

    public $id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'email'],
            ['is_admin', 'boolean', 'message' => 'Неверное значение чекбокса'],
            ['full_name', 'string', 'max' => 255],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
            'full_name' => 'Ф.И.О.',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password == '') return true;

            if (strlen($this->password) < 4) {
                $this->addError($attribute, 'Пароль должен содержать минимум 4 символа');
            }
        }
    }
}
