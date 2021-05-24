<?php

use yii\db\Migration;

/**
 * Class m210523_120501_add_performance_type
 */
class m210523_120501_add_performance_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('performance_type',[
            'id'=>$this->primaryKey(),
        ]);

        $this->createTable('performance_type_language',[
            'id'=>$this->primaryKey(),
            'performance_type_id'=>$this->integer(),
            'name'=>$this->text(),
            'language_id'=>$this->integer()
        ]);

        $this->addForeignKey('FK_performance_type_language_performance_type_id','performance_type_language','performance_type_id','performance_type','id','CASCADE');
        $this->addForeignKey('FK_performance_type_language_language_id','performance_type_language','language_id','language','id','CASCADE');

        $this->createTable('competition_performance_types',[
            'id'=>$this->primaryKey(),
            'competition_id'=>$this->integer(),
            'performance_type_id'=>$this->integer()
        ]);

        $this->addForeignKey('FK_competition_performance_types_performance_type_id','competition_performance_types','performance_type_id','performance_type','id','CASCADE');
        $this->addForeignKey('FK_competition_performance_types_competition_id','competition_performance_types','competition_id','competition','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210523_120501_add_performance_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210523_120501_add_performance_type cannot be reverted.\n";

        return false;
    }
    */
}
