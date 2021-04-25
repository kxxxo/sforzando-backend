<?php

use yii\db\Migration;

/**
 * Class m210415_103048_compilation_language
 */
class m210415_103048_compilation_language extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('compilation','title');
        $this->dropColumn('compilation','text');


        $this->createTable('compilation_language',[
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

        $this->addForeignKey('FK_compilation_language_language_id','compilation_language','language_id','language','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210415_103048_compilation_language cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210415_103048_compilation_language cannot be reverted.\n";

        return false;
    }
    */
}
