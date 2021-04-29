<?php

use yii\db\Migration;

/**
 * Class m210429_045706_FK_change_type
 */
class m210429_045706_FK_change_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('FK_application_competition_id','application');
        $this->addForeignKey('FK_application_competition_id','application','competition_id','competition','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210429_045706_FK_change_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_045706_FK_change_type cannot be reverted.\n";

        return false;
    }
    */
}
