<?php

use yii\db\Migration;

/**
 * Class m220709_140305_teacher_field_change
 */
class m220709_140305_teacher_field_change extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('application','teacher_email');
        $this->dropColumn('application','teacher_phone');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220709_140305_teacher_field_change cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220709_140305_teacher_field_change cannot be reverted.\n";

        return false;
    }
    */
}
