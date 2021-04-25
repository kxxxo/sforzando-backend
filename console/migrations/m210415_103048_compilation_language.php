<?php

use yii\db\Migration;

/**
 * Class m210415_103048_competition_language
 */
class m210415_103048_compilation_language extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('competition','title');
        $this->dropColumn('competition','text');


        $this->createTable('competition_language',[
            'id'=>$this->primaryKey(),
            'language_id'=>$this->integer()->notNull(),
            'title'=>$this->text()->notNull(),
            'text'=>$this->text()->notNull(),
        ]);

        $this->createTable('language',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'enable'=>$this->boolean()->notNull()->defaultValue(false),
            'i18_name'=>$this->string()->notNull()
        ]);

        $this->batchInsert('language',[
            'name','i18_name'
        ],[
            ['Русский','ru'],
            ['English','en'],
            ['Turkish','tr'],
            ['Arabic','ar'],
        ]);

        $this->addForeignKey('FK_competition_language_language_id','competition_language','language_id','language','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210415_103048_competition_language cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210415_103048_competition_language cannot be reverted.\n";

        return false;
    }
    */
}
