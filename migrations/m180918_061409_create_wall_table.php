<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wall`.
 */
class m180918_061409_create_wall_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('wall', [
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'message' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('wall');
    }
}
