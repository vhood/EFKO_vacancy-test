<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacations}}`.
 */
class m210209_134110_create_vacations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacations}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'date_start' => $this->date()->notNull(),
            'date_end' => $this->date()->notNull(),
            'confirmed' => $this->boolean()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-vacations-user_id',
            '{{%vacations}}',
            'user_id',
            '{{%users}}',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-vacations-user_id',
            '{{%vacations}}'
        );

        $this->dropTable('{{%vacations}}');
    }
}
