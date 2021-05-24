<?php

use yii\db\Migration;

/**
 * Class m210523_044332_create_nominations
 */
class m210523_044332_create_nominations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nomination',[
            'id'=>$this->primaryKey(),
        ]);
        $this->createTable('nomination_language',[
            'id'=>$this->primaryKey(),
            'nomination_id'=>$this->integer(),
            'name'=>$this->text(),
            'language_id'=>$this->integer()
        ]);

        $this->addForeignKey('FK_nomination_language_nomination_id','nomination_language','nomination_id','nomination','id','CASCADE');
        $this->addForeignKey('FK_nomination_language_language_id','nomination_language','language_id','language','id','CASCADE');

        $this->createTable('competition_nominations',[
            'id'=>$this->primaryKey(),
            'competition_id'=>$this->integer(),
            'nomination_id'=>$this->integer()
        ]);

        $this->addForeignKey('FK_competition_nominations_nomination_id','competition_nominations','nomination_id','nomination','id','CASCADE');
        $this->addForeignKey('FK_competition_nominations_competition_id','competition_nominations','competition_id','competition','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('competition_nominations');
        $this->dropTable('nomination_language');
        $this->dropTable('nomination');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210523_044332_create_nominations cannot be reverted.\n";

        return false;
    }
    */
}
