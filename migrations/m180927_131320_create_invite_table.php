<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invite`.
 */
class m180927_131320_create_invite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('invite', [
            'id' => $this->primaryKey(),
            'from_user' => $this->integer(11),
            'to_user' => $this->integer(11),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('invite');
    }
}
