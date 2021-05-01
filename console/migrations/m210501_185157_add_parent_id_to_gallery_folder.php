<?php

use yii\db\Migration;

/**
 * Class m210501_185157_add_parent_id_to_gallery_folder
 */
class m210501_185157_add_parent_id_to_gallery_folder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('gallery_folder','parent_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210501_185157_add_parent_id_to_gallery_folder cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210501_185157_add_parent_id_to_gallery_folder cannot be reverted.\n";

        return false;
    }
    */
}
