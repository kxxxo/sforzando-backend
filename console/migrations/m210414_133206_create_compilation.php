<?php

use yii\db\Migration;

/**
 * Class m210414_133206_create_compilation
 */
class m210414_133206_create_compilation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('competition',[
            'id'=>$this->primaryKey(),
            'title'=>$this->text()->notNull(),
            'text'=>$this->text(),
            'create_datetime'=>$this->dateTime()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'request_end_datetime'=>$this->dateTime()->notNull(),
            'start_datetime'=>$this->dateTime()->notNull(),
            'img_url'=>$this->text()->notNull(),
            'is_ended'=>$this->boolean()->defaultValue(new \yii\db\Expression('false'))->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('competition');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210414_133206_create_compilation cannot be reverted.\n";

        return false;
    }
    */
}
