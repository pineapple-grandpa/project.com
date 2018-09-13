<?php

use yii\db\Migration;

/**
 * Class m180913_111015_add_authKey_column_to_user
 */
class m180913_111015_add_authKey_column_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','auth_key',$this->string(32));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','auth_key');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180913_111015_add_authKey_column_to_user cannot be reverted.\n";

        return false;
    }
    */
}
