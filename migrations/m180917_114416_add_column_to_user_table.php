<?php

use yii\db\Migration;

/**
 * Class m180917_114416_add_column_to_user_table
 */
class m180917_114416_add_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','avatar', $this->string()->defaultValue('default.png'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','avatar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180917_114416_add_column_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
