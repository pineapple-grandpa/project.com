<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180913_090459_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40),
            'login' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'birth_date' => $this->date(),
            'gender' => $this->string(),
            'role' => $this->string()->notNull()->defaultValue('user')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
