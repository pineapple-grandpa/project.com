<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friend`.
 */
class m180927_130651_create_friend_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('friend', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'friend_id' => $this->integer(11),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('friend');
    }
}
