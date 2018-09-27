<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180926_074509_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer(11),
            'author_id' => $this->integer(11),
            'message' => $this->string(255),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}
