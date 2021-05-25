<?php

use yii\db\Migration;

/**
 * Class m210524_144258_add_fields_competition
 */
class m210524_144258_add_fields_competition extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('competition');
        $this->addColumn('competition','contact_mail',$this->string()->notNull()->defaultValue('info@sforzando-fund.com'));
        $this->addColumn('competition','end_date',$this->timestamp()->notNull());
        $this->addColumn('competition','rules_file_url',$this->string()->notNull());

        $this->alterColumn('competition','start_date',$this->timestamp()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210524_144258_add_fields_competition cannot be reverted.\n";

        return false;
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
