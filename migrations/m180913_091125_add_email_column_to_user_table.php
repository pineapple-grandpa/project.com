<?php

use yii\db\Migration;

/**
 * Handles adding email to table `user`.
 */
class m180913_091125_add_email_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','email',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','email');
    }
}
