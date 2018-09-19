<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wall`.
 */
class m180918_061409_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' =>$this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
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
        $this->dropTable('article');
    }
}
