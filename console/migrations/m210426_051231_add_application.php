<?php

use yii\db\Migration;

/**
 * Class m210426_051231_add_application
 */
class m210426_051231_add_application extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('application',[
            'id'=>$this->primaryKey(),
            'competition_id'=>$this->integer()->notNull(),
            'amount_of_participants'=>$this->integer()->notNull(),
            'comment'=>$this->text(),
            'concertmaster_fio'=>$this->string(),
            'concertmaster_phone'=>$this->string(),
            'concertmaster_email'=>$this->string(),
            'city'=>$this->string()->notNull(),
            'type_of_performance'=>$this->string()->notNull(),
            'form_of_performance'=>$this->string()->notNull(),
            'full_age'=>$this->integer()->notNull(),
            'name'=>$this->text()->notNull(),
            'school_name'=>$this->text()->notNull(),
            'nomination'=>$this->text()->notNull(),
            'parent_fio'=>$this->string(),
            'parent_email'=>$this->string(),
            'parent_phone'=>$this->string(),
            'phone'=>$this->string(),
            'picked'=>$this->string(),
            'teacher_fio'=>$this->string(),
            'teacher_email'=>$this->string()->notNull(),
            'teacher_phone'=>$this->string()->notNull()
        ]);

        $this->addForeignKey('FK_application_competition_id','application','competition_id','competition','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('application');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210426_051231_add_application cannot be reverted.\n";

        return false;
    }
    */
}
