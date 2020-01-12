<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_settings`.
 */
class m180919_085430_create_user_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_settings', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'name' => $this->string(),
            'value' => $this->boolean()->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_settings');
    }
}
