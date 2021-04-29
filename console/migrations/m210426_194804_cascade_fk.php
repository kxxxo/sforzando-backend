<?php

use yii\db\Migration;

/**
 * Class m210426_194804_cascade_fk
 */
class m210426_194804_cascade_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('FK_competition_language_competition_id','competition_language');
        $this->addForeignKey('FK_competition_language_competition_id','competition_language','competition_id','competition','id','CASCADE');

        $this->dropForeignKey('FK_judge_language_judge_id','judge_language');
        $this->addForeignKey('FK_judge_language_judge_id','judge_language','judge_id','judge','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210426_194804_cascade_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210426_194804_cascade_fk cannot be reverted.\n";

        return false;
    }
    */
}
