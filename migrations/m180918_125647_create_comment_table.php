<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180918_125647_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11),
            'author_id' => $this->integer()->notNull(),
            'author_name' => $this->string()->notNull(),
            'message' => $this->text(),
            'author_avatar' => $this->string(),
            'created_at' => $this->timestamp(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }
}
