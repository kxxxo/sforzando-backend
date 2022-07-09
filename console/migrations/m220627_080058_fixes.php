<?php

use yii\db\Migration;


class m220627_080058_fixes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('competition','contact_telephone',$this->text()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('competition','contact_telephone');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210524_144258_add_fields_competition cannot be reverted.\n";

        return false;
    }
    */
}
