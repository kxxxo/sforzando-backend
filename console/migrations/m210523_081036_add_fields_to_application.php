<?php

use yii\db\Migration;

/**
 * Class m210523_081036_add_fields_to_application
 */
class m210523_081036_add_fields_to_application extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('application','contact_mail',$this->string()->notNull());
        $this->addColumn('application','requisite',$this->string());
        $this->addColumn('application','content_url',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210523_081036_add_fields_to_application cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210523_081036_add_fields_to_application cannot be reverted.\n";

        return false;
    }
    */
}
