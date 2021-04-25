<?php

use yii\db\Migration;

/**
 * Class m210415_111336_add_jury
 */
class m210415_111336_add_jury extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('judge',[
            'id'=>$this->primaryKey(),
            'img_url'=>$this->string()->notNull(),
        ]);

        $this->createTable('judge_language',[
            'id'=>$this->primaryKey(),
            'language_id'=>$this->integer()->notNull(),
            'judge_id'=>$this->integer()->notNull(),
            'fio'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull()
        ]);

        $this->addForeignKey('FK_judge_language_judge_id','judge_language','judge_id','judge','id');
        $this->addForeignKey('FK_judge_language_language_id','judge_language','language_id','language','id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210415_111336_add_judge cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210415_111336_add_jury cannot be reverted.\n";

        return false;
    }
    */
}
