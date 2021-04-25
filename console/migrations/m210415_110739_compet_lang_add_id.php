<?php

use yii\db\Migration;

/**
 * Class m210415_110739_compet_lang_add_id
 */
class m210415_110739_compet_lang_add_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('compilation_language','compilation_id',$this->integer()->notNull());
        $this->addForeignKey('FK_compilation_language_compilation_id','compilation_language','compilation_id','compilation','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210415_110739_compet_lang_add_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210415_110739_compet_lang_add_id cannot be reverted.\n";

        return false;
    }
    */
}
