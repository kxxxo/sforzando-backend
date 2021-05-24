<?php

use yii\db\Migration;

/**
 * Class m210523_130300_revertp_comp
 */
class m210523_130300_revertp_comp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('application','full_age');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210523_130300_revertp_comp cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210523_130300_revertp_comp cannot be reverted.\n";

        return false;
    }
    */
}
