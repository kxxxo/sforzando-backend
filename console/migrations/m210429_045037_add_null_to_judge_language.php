<?php

use yii\db\Migration;

/**
 * Class m210429_045037_add_null_to_judge_language
 */
class m210429_045037_add_null_to_judge_language extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('judge_language','fio',$this->text());
        $this->alterColumn('judge_language','description',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210429_045037_add_null_to_judge_language cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_045037_add_null_to_judge_language cannot be reverted.\n";

        return false;
    }
    */
}
