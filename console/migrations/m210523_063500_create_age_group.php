<?php

use yii\db\Migration;

/**
 * Class m210523_063500_create_age_group
 */
class m210523_063500_create_age_group extends Migration
{
    public function safeUp()
    {
        $this->createTable('age_group',[
            'id'=>$this->primaryKey(),
            'full_years'=>$this->integer()->defaultValue(0)->notNull()
        ]);
        $this->createTable('age_group_language',[
            'id'=>$this->primaryKey(),
            'age_group_id'=>$this->integer(),
            'name'=>$this->text(),
            'language_id'=>$this->integer()
        ]);

        $this->addForeignKey('FK_age_group_language_age_group_id','age_group_language','age_group_id','age_group','id','CASCADE');
        $this->addForeignKey('FK_age_group_language_language_id','age_group_language','language_id','language','id','CASCADE');

        $this->createTable('competition_age_groups',[
            'id'=>$this->primaryKey(),
            'competition_id'=>$this->integer(),
            'age_group_id'=>$this->integer()
        ]);

        $this->addForeignKey('FK_competition_age_groups_age_group_id','competition_age_groups','age_group_id','age_group','id','CASCADE');
        $this->addForeignKey('FK_competition_age_groups_competition_id','competition_age_groups','competition_id','competition','id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('competition_age_groups');
        $this->dropTable('age_group_language');
        $this->dropTable('age_group');
    }

}
