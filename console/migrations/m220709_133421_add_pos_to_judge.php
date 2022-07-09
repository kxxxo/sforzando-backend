<?php

use yii\db\Migration;

/**
 * Class m220709_133421_add_pos_to_judge
 */
class m220709_133421_add_pos_to_judge extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('judge','pos',$this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('judge','pos');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220709_133421_add_pos_to_judge cannot be reverted.\n";

        return false;
    }
    */
}
