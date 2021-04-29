<?php

use yii\db\Migration;

/**
 * Class m210428_125117_add_null_to_comp_languages
 */
class m210428_125117_add_null_to_comp_languages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('competition_language','title',$this->text());
        $this->alterColumn('competition_language','text',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210428_125117_add_null_to_comp_languages cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210428_125117_add_null_to_comp_languages cannot be reverted.\n";

        return false;
    }
    */
}
