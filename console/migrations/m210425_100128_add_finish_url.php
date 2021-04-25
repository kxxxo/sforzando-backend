<?php

use yii\db\Migration;

/**
 * Class m210425_100128_add_finish_url
 */
class m210425_100128_add_finish_url extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('competition','result_url',$this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_100128_add_finish_url cannot be reverted.\n";

        return false;
    }
    */
}
