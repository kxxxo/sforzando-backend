<?php

use yii\db\Migration;

/**
 * Class m210425_100338_datetime_to_date
 */
class m210425_100338_datetime_to_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('competition','start_datetime',$this->date());
        $this->renameColumn('competition','start_datetime','start_date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210425_100338_datetime_to_date cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_100338_datetime_to_date cannot be reverted.\n";

        return false;
    }
    */
}
