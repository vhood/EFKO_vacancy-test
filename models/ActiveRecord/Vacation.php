<?php

namespace app\models\ActiveRecord;

use Yii;

/**
 * This is the model class for table "vacations".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date_start
 * @property string $date_end
 * @property int|null $confirmed
 *
 * @property Users $user
 */
class Vacation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'required'],
            [['date_start', 'date_end'], 'date', 'format' => 'yyyy-mm-dd'],
            ['date_start', 'compare', 'compareValue' => date('Y-m-d', time()), 'operator' => '>', 'type' => 'date'],
            ['date_end', 'compare', 'compareAttribute' => 'date_start', 'operator' => '>', 'type' => 'date'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public function getUserRow()
    {
        $user = $this->user;
        $row = $user->full_name ?? 'Пользователь';
        $row .= ' '.$user->email;

        return $row;
    }
}
