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
        $this->createTable('jury',[
            'id'=>$this->primaryKey(),
            'img_url'=>$this->string()->notNull(),
        ]);

        $this->createTable('jury_language',[
            'id'=>$this->primaryKey(),
            'language_id'=>$this->integer()->notNull(),
            'jury_id'=>$this->integer()->notNull(),
            'fio'=>$this->string()->notNull(),
            'description'=>$this->text()->notNull()
        ]);

        $this->addForeignKey('FK_jury_language_jury_id','jury_language','jury_id','jury','id');
        $this->addForeignKey('FK_jury_language_language_id','jury_language','language_id','language','id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210415_111336_add_jury cannot be reverted.\n";

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
