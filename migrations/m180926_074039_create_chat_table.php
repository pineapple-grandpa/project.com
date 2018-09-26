<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat`.
 */
class m180926_074039_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'first_user_id' => $this->integer(11),
            'second_user_id' => $this->integer(11),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chat');
    }
}
